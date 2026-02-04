<?php

namespace App\Services; // ni
use App\Models\Task;// bro lupe ke
use App\Services\OpenAiClient;

class AiTaskService
{
    public static function generateSubtasks(Task $task)//: array
    {
        $prompt = "
        Break the following task into clear actionable subtasks:

        Title: {$task->title}
        Description: {$task->description}

        Respond ONLY in JSON:
        {
          \"subtasks\": [\"subtask 1\", \"subtask 2\"]
        }
        ";

        $response = OpenAiClient::ask($prompt); //returned as array o

        //return $response['subtasks'] ?? [];

          // Send the full array to Postman
    return response()->json($response); //arr -> json
    //return $response;
    }
}
