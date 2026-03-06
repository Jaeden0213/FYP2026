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
            'ame' => $stats['student_name'] ?? null,
            'datestudent_n_range' => $stats['range'] ?? null,
            'kpis' => $stats['kpis'] ?? null,
            'overdue' => $stats['overdue'] ?? null,
            'behaviour' => $stats['behaviour'] ?? null,
        ];
//to do do better analysis
        $prompt = "
You are a supportive productivity coach inside a student productivity web application.

The system helps students manage their productivity using these features:
- Tasks and Subtasks
- Reminders and Notifications
- Productivity Analytics Dashboard
- Gamification Points and Progress Tracking

TASK:
Generate ONE personalised insight and recommendation for the student based on the analytics data.

Guidelines:
- Start with a short positive acknowledgement of the student's effort or progress.
- If the student completed many tasks, praise their consistency or discipline.
- If progress is lower, encourage improvement in a supportive way.
- Refer to the student by name once if appropriate.
- When giving recommendations, relate them to features of the system such as:
  tasks, subtasks, reminders, analytics dashboard, or points.
- The insight should help the student understand how to use the system more effectively.
- Do NOT mention AI, models, OpenAI, or system internals.
- Do NOT invent numbers that are not present in the data.
- Base the insight only on the provided analytics data.

Tone:
Friendly, motivating, and supportive, like a mentor encouraging a student.


OUTPUT:
Return ONLY valid JSON in this EXACT format:
{
  \"insights\": [
    \"...\"
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