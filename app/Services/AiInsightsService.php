<?php

namespace App\Services;

use App\Services\OpenAiClient;

class AiInsightsService
{
    /**
     * Generate AI insights based on mined analytics stats (NOT raw tasks).
     * Returns: ["insights" => ["...", "..."]]
     */
    public static function generateInsights(array $stats): array
    {
        // Keep stats small and clean (AI works better)
        $payload = [
            'name' => $stats['student_name'] ?? null,
            'datestudent_n_range' => $stats['range'] ?? null,
            'kpis' => $stats['kpis'] ?? null,
            'overdue' => $stats['overdue'] ?? null,
            'behaviour' => $stats['behaviour'] ?? null,
        ];
//to do do better analysis, separate into two sections: 1) performance (kpis, trends) 2) behaviour (daily/weekly summaries) 3) Solution based on my behaviour (eg if I procrastinate a lot, recommend using reminders more often)
$prompt = "
You are a supportive productivity coach inside a student productivity web application.

The system helps students manage their productivity using these features:
- Tasks and Subtasks
- Reminders and Notifications
- Productivity Analytics Dashboard
- Gamification Points and Progress Tracking

TASK:
Generate ONE structured analysis for the student based on the analytics data.

Your response must contain THREE clearly separated sections in this order:

Performance:
- Analyse the student's performance using the KPIs and task completion data.
- Mention patterns such as completion rate, productivity trends, or workload handling.

Behaviour:
- Describe the student's work behaviour or productivity habits.
- Examples: disciplined, consistent, improving, procrastinating, deadline-driven, productive at certain hours.

Recommendation:
- Provide ONE practical recommendation to improve or maintain productivity.
- The recommendation should reference system features such as tasks, subtasks, reminders, analytics dashboard, or productivity habits.

IMPORTANT RULES:
- Each section must appear on a NEW LINE.
- The section titles must be BOLD.
- Use HTML formatting exactly like this:
  <strong>Performance:</strong>
  <strong>Behaviour:</strong>
  <strong>Recommendation:</strong>
- Each section should contain 1–2 sentences.
- Do NOT invent numbers not present in the data.
- Do NOT mention AI, models, OpenAI, or system internals.
- Base everything only on the provided analytics data.

Tone:
Friendly, constructive, and encouraging, like a mentor analysing a student's productivity.

OUTPUT:
Return ONLY valid JSON in this EXACT format:

{
  \"insights\": [
    \"<strong>Performance:</strong> ...<br><br><strong>Behaviour:</strong> ...<br><br><strong>Recommendation:</strong> ...\"
  ]
}

ANALYTICS DATA:
" . json_encode($payload, JSON_PRETTY_PRINT);

        $response = OpenAiClient::ask($prompt);

        // Safety: if AI returns nothing, fallback to empty
        if (!is_array($response) || !isset($response['insights']) || !is_array($response['insights'])) {
            return ['insights' => []];
        }

        // Clean
        $insights = array_values(array_filter(array_map(fn($s) => trim((string)$s), $response['insights'])));
        $insights = array_slice($insights, 0, 6);

        return ['insights' => $insights];
    }
}