<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    // FR13: Filtering (date range, status, category)
    public function parseFilters(Request $request): array
    {
        // Get filter values from query string, e.g. ?from=2026-03-01&to=2026-03-08
        $from = $request->query('from');
        $to   = $request->query('to');

        // If user provides a start date, use that date at 00:00:00
        // Otherwise default to the last 7 days
        $dateFrom = $from ? Carbon::parse($from)->startOfDay() : now()->subDays(6)->startOfDay();

        // If user provides an end date, use that date at 23:59:59
        // Otherwise default to today
        $dateTo   = $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay();

        // Return all filters in one array so other methods can reuse them
        return [
            'from' => $dateFrom,
            'to' => $dateTo,
            'status' => $request->query('status'),
            'category' => $request->query('category'),
        ];
    }

    /**
     * Base reusable query for task analytics.
     *
     * This method applies the common filters:
     * - current user's tasks only
     * - tasks created within selected date range
     * - optional status filter
     * - optional category filter
     *
     * Other methods clone this query and build on top of it.
     */
    private function baseQuery(int $userId, array $filters)
    {
        $q = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$filters['from'], $filters['to']]);

        // Apply status filter only if user selected one
        if (!empty($filters['status'])) {
            $q->where('status', $filters['status']);
        }

        // Apply category filter only if user selected one
        if (!empty($filters['category'])) {
            $q->where('category', $filters['category']);
        }

        return $q;
    }

    /**
     * KPI cards on Overview tab.
     *
     * Calculates:
     * - total tasks
     * - completed tasks
     * - pending/in-progress tasks
     * - completion percentage
     */
    public function kpis(int $userId, array $filters): array
    {
        // Count all filtered tasks
        $total = (clone $this->baseQuery($userId, $filters))->count();

        // Count only completed tasks from the filtered set
        $completed = (clone $this->baseQuery($userId, $filters))
            ->where('status', 'completed')
            ->count();

        // Count pending and in_progress tasks as unfinished work
        $pending = (clone $this->baseQuery($userId, $filters))
            ->whereIn('status', ['pending', 'in_progress'])
            ->count();

        // Prevent division by zero
        $percentage = $total > 0 ? round(($completed / $total) * 100, 0) : 0;

        return [
            'total_tasks' => $total,
            'completed_tasks' => $completed,
            'pending_tasks' => $pending,
            'completion_percentage' => $percentage,
        ];
    }

    /**
     * FR10: Completed Tasks (last 7 days ending at selected "to" date)
     *
     * This chart shows how many tasks were marked completed on each day
     * in the last 7 days.
     *
     * Important:
     * - It uses updated_at, because task status changes to completed later
     * - It groups results by DATE(updated_at)
     */
    public function completedLast7Days(int $userId, ?array $filters = null): array
    {
        // Use selected "to" date as chart end date if available, otherwise today
        $end = isset($filters['to'])
            ? $filters['to']->copy()->endOfDay()
            : now()->endOfDay();

        // Start date is 6 days before end date, giving a 7-day range total
        $start = $end->copy()->subDays(6)->startOfDay();

        // Get number of completed tasks grouped by completion day
        $rows = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$start, $end])
            ->selectRaw("DATE(updated_at) as day, COUNT(*) as count")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Convert result into key-value map like:
        // ['2026-03-02' => 3, '2026-03-03' => 5]
        $map = $rows->pluck('count', 'day')->toArray();

        $labels = [];
        $data = [];

        // Ensure every day in the last 7 days is shown on the chart
        // If no tasks were completed that day, use 0
        for ($i = 6; $i >= 0; $i--) {
            $d = $end->copy()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($d)->format('d M');
            $data[] = (int) ($map[$d] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * FR11: Daily + Weekly summaries
     *
     * Returns simple text summaries to display in the dashboard.
     *
     * If filters exist:
     * - summary is based on selected date range
     *
     * If no filters:
     * - summary is based on today and current week
     */
    public function dailyWeeklySummary(int $userId, ?array $filters = null): array
    {
        if ($filters) {
            // Count tasks completed within filtered date range
            $rangeCompleted = DB::table('tasks')
                ->where('user_id', $userId)
                ->where('status', 'completed')
                ->whereBetween('updated_at', [$filters['from'], $filters['to']])
                ->count();

            // Count tasks created within filtered date range
            $rangeTotal = DB::table('tasks')
                ->where('user_id', $userId)
                ->whereBetween('created_at', [$filters['from'], $filters['to']])
                ->count();

            return [
                'daily' => "Within the selected range, you completed {$rangeCompleted} task(s).",
                'weekly' => "In this filtered view, you created {$rangeTotal} task(s) in total.",
            ];
        }

        // Default summary: tasks completed today
        $todayCompleted = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [now()->startOfDay(), now()->endOfDay()])
            ->count();

        // Default summary: tasks completed this week
        $weekCompleted = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return [
            'daily' => "Today you completed {$todayCompleted} task(s).",
            'weekly' => "This week you completed {$weekCompleted} task(s).",
        ];
    }

    /**
     * FR12: Completed vs Pending over selected date range
     *
     * This chart compares:
     * - number of tasks currently completed
     * - number of tasks currently pending/in progress
     *
     * grouped by task creation date.
     *
     * Important:
     * - This uses created_at, not updated_at
     * - So it shows task status distribution for tasks created on each day
     */
    public function completedVsPendingTrend(int $userId, array $filters): array
    {
        $from = $filters['from']->copy()->startOfDay();
        $to = $filters['to']->copy()->endOfDay();

        $rows = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$from, $to])

            // Optional filter by category
            ->when($filters['category'], fn($q) => $q->where('category', $filters['category']))

            // Optional filter by one selected status
            ->when($filters['status'], fn($q) => $q->where('status', $filters['status']))

            // Group by day and count completed vs pending/in_progress
            ->selectRaw("
                DATE(created_at) as day,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status IN ('pending','in_progress') THEN 1 ELSE 0 END) as pending
            ")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Convert DB results into a map for quick lookup
        $map = [];
        foreach ($rows as $r) {
            $map[$r->day] = $r;
        }

        $labels = [];
        $completed = [];
        $pending = [];

        // Loop through every day in selected range
        // Fill missing dates with 0 so the line chart stays continuous
        $cursor = $from->copy();
        while ($cursor->lte($to)) {
            $key = $cursor->format('Y-m-d');
            $labels[] = $cursor->format('d M');
            $completed[] = isset($map[$key]) ? (int) $map[$key]->completed : 0;
            $pending[] = isset($map[$key]) ? (int) $map[$key]->pending : 0;
            $cursor->addDay();
        }

        return [
            'labels' => $labels,
            'completed' => $completed,
            'pending' => $pending,
        ];
    }

    /**
     * FR14: Historical trends
     *
     * Shows how many tasks were completed per week
     * within the selected date range.
     *
     * It uses YEARWEEK(updated_at, 1):
     * - YEARWEEK groups dates by ISO week number
     * - updated_at is used because completed tasks are counted when updated
     */
public function historicalTrends(int $userId, array $filters): array
{
    $rows = DB::table('tasks')
        ->where('user_id', $userId)
        ->where('status', 'completed')
        ->whereBetween('updated_at', [$filters['from'], $filters['to']])
        ->when($filters['category'], fn($q) => $q->where('category', $filters['category']))
        ->selectRaw("YEARWEEK(updated_at, 1) as yw, COUNT(*) as count")
        ->groupBy('yw')
        ->orderBy('yw')
        ->get();

    $weekLabels = $rows->map(function ($row) {
        $yw = (string) $row->yw;

        $year = (int) substr($yw, 0, 4);
        $week = (int) substr($yw, 4);

        $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->endOfWeek();

        return "Year {$year} Week {$week} (" .
            $startOfWeek->format('M j') . ' - ' . $endOfWeek->format('M j') . ")";
    })->toArray();

    return [
        'weeks' => $weekLabels, // for chart display
        'weeks_raw' => $rows->pluck('yw')->toArray(), // keep raw values for AI / future logic
        'counts' => $rows->pluck('count')->map(fn($v) => (int) $v)->toArray(),
    ];
}

    /**
     * Counts overdue unfinished tasks.
     *
     * A task is considered overdue if:
     * - status is pending or in_progress
     * - due_date exists
     * - due_date is before today
     */
    public function overduePendingCount(int $userId): int
    {
        return DB::table('tasks')
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'in_progress'])
            ->whereNotNull('due_date')
            ->where('due_date', '<', now()->toDateString())
            ->count();
    }

    public function historicalWeekView(int $userId, int $weekOffset = 0, ?string $category = null): array
{
    $startOfWeek = now()->startOfWeek()->addWeeks($weekOffset);
    $endOfWeek = now()->endOfWeek()->addWeeks($weekOffset);

    $rows = DB::table('tasks')
        ->where('user_id', $userId)
        ->where('status', 'completed')
        ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
        ->when($category, fn($q) => $q->where('category', $category))
        ->selectRaw("DATE(updated_at) as day, COUNT(*) as count")
        ->groupBy('day')
        ->orderBy('day')
        ->get();

    $map = $rows->pluck('count', 'day')->map(fn($v) => (int) $v)->toArray();

    $labels = [];
    $counts = [];

    $cursor = $startOfWeek->copy();
    while ($cursor->lte($endOfWeek)) {
        $key = $cursor->format('Y-m-d');
        $labels[] = $cursor->format('D'); // Mon, Tue, Wed...
        $counts[] = $map[$key] ?? 0;
        $cursor->addDay();
    }

    return [
        'week_label' => 'Year ' . $startOfWeek->isoWeekYear .
            ' Week ' . $startOfWeek->isoWeek .
            ' (' . $startOfWeek->format('M j') . ' - ' . $endOfWeek->format('M j') . ')',
        'week_offset' => $weekOffset,
        'labels' => $labels,
        'counts' => $counts,
    ];
}

    // FR15 + FR16: rule-based insights from behaviour patterns
    public function insights(int $userId): array
    {
        $thisWeekFrom = now()->startOfWeek();
        $thisWeekTo = now()->endOfWeek();
        $lastWeekFrom = now()->subWeek()->startOfWeek();
        $lastWeekTo = now()->subWeek()->endOfWeek();

        $thisWeekTotal = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$thisWeekFrom, $thisWeekTo])
            ->count();

        $thisWeekCompleted = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$thisWeekFrom, $thisWeekTo])
            ->count();

        $lastWeekTotal = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$lastWeekFrom, $lastWeekTo])
            ->count();

        $lastWeekCompleted = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$lastWeekFrom, $lastWeekTo])
            ->count();

        $thisRate = $thisWeekTotal > 0 ? ($thisWeekCompleted / $thisWeekTotal) : 0;
        $lastRate = $lastWeekTotal > 0 ? ($lastWeekCompleted / $lastWeekTotal) : 0;

        $overduePending = $this->overduePendingCount($userId);

        $peakHour = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->selectRaw("HOUR(updated_at) as hr, COUNT(*) as c")
            ->groupBy('hr')
            ->orderByDesc('c')
            ->first();

        $insights = [];

        if ($thisRate + 0.001 < $lastRate) {
            $insights[] = "Your completion rate dropped this week; try scheduling fixed revision slots.";
        }

        if ($thisRate < 0.4 && $thisWeekTotal >= 5) {
            $insights[] = "You completed less than 40% of your tasks this week; try breaking large tasks into smaller subtasks.";
        }

        if ($overduePending >= 3) {
            $insights[] = "You have {$overduePending} overdue tasks; prioritise the earliest deadlines and set reminders.";
        }

        if ($peakHour) {
            $label = Carbon::createFromTime((int) $peakHour->hr)->format('g A');
            $insights[] = "You tend to complete more tasks around {$label}; try doing your hardest tasks during this time.";
        }

        if (empty($insights)) {
            $insights[] = "Good consistency so far; review your charts weekly to stay on track.";
        }

        return $insights;
    }
}