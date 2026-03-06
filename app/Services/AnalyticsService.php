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
        $from = $request->query('from');
        $to   = $request->query('to');

        // Default: last 7 days (created_at)
        $dateFrom = $from ? Carbon::parse($from)->startOfDay() : now()->subDays(6)->startOfDay();
        $dateTo   = $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay();
        $status = $request->query('status');     // pending | in_progress | completed | null
        $category = $request->query('category'); // chores | exercise | study | assignment | null

        return [
            'from' => $dateFrom,
            'to' => $dateTo,
            'status' => $status,
            'category' => $category,
        ];
    }

    private function baseQuery(int $userId, array $filters)
    {
        $q = DB::table('tasks')
            ->where('user_id', $userId)
            // Use created_at for "selected date range" filtering
            ->whereBetween('created_at', [$filters['from'], $filters['to']]);

        if (!empty($filters['status'])) {
            $q->where('status', $filters['status']);
        }

        if (!empty($filters['category'])) {
            $q->where('category', $filters['category']);
        }

        return $q;
    }

    public function kpis(int $userId, array $filters): array
    {
        // total tasks ikut filter (date range + optional status/category)
        // clone sebab baseQuery tu kita nak reuse banyak kali
        $total = (clone $this->baseQuery($userId, $filters))->count();

        // kira completed tasks dalam range yang sama
        $completed = (clone $this->baseQuery($userId, $filters))
            ->where('status', 'completed')
            ->count();

        // kira pending + in_progress sekali (kira belum siap la ni)
        $pending = (clone $this->baseQuery($userId, $filters))
            ->whereIn('status', ['pending', 'in_progress'])
            ->count();

        //  elak division by zero (kalau total=0) if not then percentage akan jadi infinity or error, kita set 0 je kalau total=0
        // completion % = completed / total * 100
        $percentage = $total > 0 ? round(($completed / $total) * 100, 0) : 0;

        // ✅ return data untuk frontend guna (KPIs cards)
        return [
            'total_tasks' => $total,
            'completed_tasks' => $completed,
            'pending_tasks' => $pending,
            'completion_percentage' => $percentage,
        ];
    }


    // FR10: Completed Tasks (Last 7 Days)
    // sebab takde completed_at column,
    // kita anggap task "completed time" = updated_at (ONLY bila status='completed')
    public function completedLast7Days(int $userId): array
    {
        //start = 6 hari lepas (so total 7 days termasuk hari ni)
        $start = now()->subDays(6)->startOfDay();
        $end   = now()->endOfDay();

        // ambil semua task yang completed dalam last 7 days based on updated_at
        // DATE(updated_at) = group ikut hari (2026-03-06 etc)
        $rows = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$start, $end])
            ->selectRaw("DATE(updated_at) as day, COUNT(*) as count")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // convert jadi map: ['2026-03-01' => 3, '2026-03-02' => 0 ...]
        $map = $rows->pluck('count', 'day')->toArray();

        $labels = [];
        $data   = [];

        //ensure chart sentiasa ada 7 hari (kalau takde data pun letak 0)
        for ($i = 6; $i >= 0; $i--) {
            $d = now()->subDays($i)->format('Y-m-d');      // key utk map
            $labels[] = Carbon::parse($d)->format('d M');  // label cantik: 06 Mar
            $data[] = (int)($map[$d] ?? 0);                // kalau tak wujud, set 0
        }

        //return untuk Chart.js 
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }


    // FR11: Daily + Weekly summaries
    public function dailyWeeklySummary(int $userId): array
    {
        //kira tasks yang completed hari ni
        // updated_at sebab kita assume completion time = updated_at bila completed
        $todayCompleted = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [now()->startOfDay(), now()->endOfDay()])
            ->count();

        //kira tasks yang completed minggu ni
        $weekCompleted = DB::table('tasks')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        // return siap punya ayat to display at UI situ (bukan just number, tapi terus jadi insight)
        return [
            'daily' => "Today you completed {$todayCompleted} task(s).",
            'weekly' => "This week you completed {$weekCompleted} task(s).",
        ];
    }
    // FR12: Completed vs Pending over selected date range
    public function completedVsPendingTrend(int $userId, array $filters): array
    {
        $from = $filters['from']->copy()->startOfDay();
        $to = $filters['to']->copy()->endOfDay();

        $rows = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$from, $to])
            ->when($filters['category'], fn($q) => $q->where('category', $filters['category']))
            ->selectRaw("
                DATE(created_at) as day,
                SUM(CASE WHEN status='completed' THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN status IN ('pending','in_progress') THEN 1 ELSE 0 END) as pending
            ")
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $map = [];
        foreach ($rows as $r) $map[$r->day] = $r;

        $labels = [];
        $completed = [];
        $pending = [];

        $cursor = $from->copy();
        while ($cursor->lte($to)) {
            $key = $cursor->format('Y-m-d');
            $labels[] = $cursor->format('d M');
            $completed[] = isset($map[$key]) ? (int)$map[$key]->completed : 0;
            $pending[] = isset($map[$key]) ? (int)$map[$key]->pending : 0;
            $cursor->addDay();
        }

        return [
            'labels' => $labels,
            'completed' => $completed,
            'pending' => $pending,
        ];
    }

    // FR14: Historical trends (weekly completed count in selected range)
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

        return [
            'weeks' => $rows->pluck('yw')->toArray(),
            'counts' => $rows->pluck('count')->map(fn($v)=>(int)$v)->toArray(),
        ];
    }

    // FR15 + FR16: rule-based insights from behaviour patterns
    public function insights(int $userId): array
    {
        $thisWeekFrom = now()->startOfWeek();
        $thisWeekTo   = now()->endOfWeek();
        $lastWeekFrom = now()->subWeek()->startOfWeek();
        $lastWeekTo   = now()->subWeek()->endOfWeek();

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

        // Overdue pending tasks (you have due_date ✅)
        $overduePending = DB::table('tasks')
            ->where('user_id', $userId)
            ->whereIn('status', ['pending', 'in_progress'])
            ->whereNotNull('due_date')
            ->where('due_date', '<', now()->toDateString())
            ->count();

        // Peak productive time (using end_time if exists, else updated_at hour)
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
            $insights[] = "You completed less than 40% of your tasks this week; try breaking tasks into smaller subtasks.";
        }

        if ($overduePending >= 3) {
            $insights[] = "You have {$overduePending} overdue tasks; prioritise the earliest deadlines and set reminders.";
        }

        if ($peakHour) {
            $label = Carbon::createFromTime((int)$peakHour->hr)->format('g A');
            $insights[] = "You tend to complete more tasks around {$label}; try doing your hardest tasks during this time.";
        }

        if (empty($insights)) {
            $insights[] = "Good consistency so far; review your charts weekly to stay on track.";
        }

        return $insights;
    }
}