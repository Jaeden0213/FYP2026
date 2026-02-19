<?php

namespace App\Services; // ni
use App\Models\Task;// bro lupe ke
use App\Services\OpenAiClient;
use Illuminate\Http\Request;

class AiTaskService
{
    public static function generateSubtasks(Task $task , $existingSubtasks = [])//: array
    {
       

        // Turn existing subtasks into a string so the AI can see them
    $currentList = collect($existingSubtasks)->map(function($s) use ($task) { 
    return "- {$s->title} (Previous Weight: " . ($s->points / ($task->points ?: 1)) . ")";
})->implode("\n");

    $prompt = "
        Main Task: {$task->title}
        Description: {$task->description}

        Existing Subtasks:
        {$currentList}

        INSTRUCTION:
        1. Break the task into 3-5 clear actionable subtasks.
        2. If I provided 'Existing Subtasks' above, INCLUDE them in your response but you may refine their titles/descriptions.
        3. Add new subtasks if necessary to reach the 3-5 range.
        4. For each subtask, assign a 'weight' (decimal between 0.1 and 0.9).
        5. The SUM of ALL weights in your response must equal exactly 1.0.

        Respond ONLY in JSON:
        {
          \"subtasks\": [
            {
              \"title\": \"Subtask Title\",
              \"description\": \"Subtask Description\",
              \"priority\": \"high/medium/low\",
              \"weight\": 0.3
            }
          ]
        }
        ";

        // $prompt = "
        //Break the following task into 3- 5 clear actionable subtasks with title description, priority and 
        //for points assign a 'weight' (a decimal between 0.1 and 0.9) 
        //representing its complexity. 
        //The SUM of all weights must equal exactly 1.0. :

       // Title: {$task->title}
       // Description: {$task->description}

       // Respond ONLY in JSON:
       // {
      //    \"subtasks\": [\"subtask 1\", \"subtask 2\"]
       // }
       // ";

    return OpenAiClient::ask($prompt);

        $response = OpenAiClient::ask($prompt); //returned as array o

        

          
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
