<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnalyticsService;
use App\Services\AiInsightsService;

class AnalyticsController extends Controller
{
    public function __construct(private AnalyticsService $service) {}

    // FR17: Page with 3 tabs
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'overview');
        return view('analytics.index', compact('tab'));
    }

    // FR9 FR10 FR11
    public function overviewData(Request $request)
    {
        $userId = auth()->id();
        $filters = $this->service->parseFilters($request);

        return response()->json([
            'kpis' => $this->service->kpis($userId, $filters),
            'last7CompletedChart' => $this->service->completedLast7Days($userId),
            'summaries' => $this->service->dailyWeeklySummary($userId),
        ]);
    }

    // FR12 FR13 FR14
    public function chartsData(Request $request)
    {
        $userId = auth()->id();
        $filters = $this->service->parseFilters($request);

        return response()->json([
            'completedVsPending' => $this->service->completedVsPendingTrend($userId, $filters),
            'historical' => $this->service->historicalTrends($userId, $filters),
        ]);
    }

    // FR15 FR16
    public function insightsData(Request $request)
    {
        $userId = auth()->id();
        $filters = $this->service->parseFilters($request);

        $summaries = $this->service->dailyWeeklySummary($userId);

        // rule-based insights (fallback)
        $ruleInsights = $this->service->insights($userId);

        // collect mined analytics stats
        $stats = [
            'student_name' => auth()->user()->name,
            'range' => [
                'from' => $filters['from']->toDateString(),
                'to' => $filters['to']->toDateString(),
            ],
            'kpis' => $this->service->kpis($userId, $filters),
            'behaviour' => [
                'daily_summary' => $summaries['daily'],
                'weekly_summary' => $summaries['weekly'],
            ],
            'last7days' => $this->service->completedLast7Days($userId),
            'ruleInsights' => $ruleInsights,
        ];

        // AI insights
        $ai = AiInsightsService::generateInsights($stats);

        // fallback if AI fails
        $insights = !empty($ai['insights']) ? $ai['insights'] : $ruleInsights;

        return response()->json([
            'insights' => $insights
        ]);
    }
}