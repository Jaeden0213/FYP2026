<?php

namespace App\Services; // ni
use App\Models\Task;// bro lupe ke
use App\Services\OpenAiClient;
use Illuminate\Http\Request;

class AiTaskService
{
    public static function generateSubtasks(Task $task)//: array
    {
        $prompt = "
        Break the following task into 3- 5 clear actionable subtasks with title description, priority and 
        for points assign a 'weight' (a decimal between 0.1 and 0.9) 
        representing its complexity. 
        The SUM of all weights must equal exactly 1.0. :

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
    //return response()->json($response); //arr -> json
    return $response;
    }

    public function generateTaskPointsViaAI(Request $request){

      $prompt = "
      You are a gamification engine. Assign task points (1-100) based on these rules:
      1. Base effort: How much time/energy does the Title and Description imply?
      2. Priority Multiplier: High priority tasks get a 50% bonus.
      3. Complexity: More detailed descriptions suggest higher effort.

      Task Details:
      - Title: {$request->title}
      - Description: {$request->description}
      - Priority: {$request->priority}
      - Category: {$request->category}

      Respond ONLY in valid JSON:
      {
        \"points\": 50
      }";

       // This currently returns ['points' => 50]
       $response = OpenAiClient::ask($prompt);

       // FIX: Reach into the array and get the actual integer
       if (is_array($response) && isset($response['points'])) {
        return (int) $response['points']; 
    }

    }

    public function generateSubTaskPointsViaAI(Request $request){

      $prompt = "
      You are a gamification engine. Assign task points (1-100) based on these rules:
      1. Base effort: How much time/energy does the Title and Description imply?
      2. Priority Multiplier: High priority tasks get a 50% bonus.
      3. Complexity: More detailed descriptions suggest higher effort.

      Task Details:
      - Title: {$request->title}
      - Description: {$request->description}
      - Priority: {$request->priority}
      - Category: {$request->category}

      Respond ONLY in valid JSON:
      {
        \"points\": 50
      }";

       // This currently returns ['points' => 50]
       $response = OpenAiClient::ask($prompt);

       // FIX: Reach into the array and get the actual integer
       if (is_array($response) && isset($response['points'])) {
        return (int) $response['points']; 
    }

    }


    // gen points
   // public static function ($validated) {

    //extract title, desc, category, prizority
    // tell ai importantce of points

    //return points

    
    //}
}
