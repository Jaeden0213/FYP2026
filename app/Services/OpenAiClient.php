<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAiClient
{
    public static function ask(string $prompt)//: array
    {
         $apiKey = config('services.openai.key');

        if (!$apiKey) {
            return [
                'error' => 'OpenAI API key not set in .env'
            ];
        }

      //  $response = Http::withToken(config('services.openai.key'))
        //    ->post('https://api.openai.com/v1/chat/completions', [
                //'model' => 'gpt-4o-mini',
         //       'model' => 'gpt-3.5-turbo',

         //       'messages' => [
          //          ['role' => 'user', 'content' => $prompt]
         //       ],
       //         'temperature' => 0.2
         //   ]);

      //   $response = Http::withToken(config('services.deepseek.key'))
  //  ->post('https://api.deepseek.com/chat/completions', [
     //   'model' => 'deepseek-chat',
     //   'messages' => [
    //        ['role' => 'system', 'content' => 'You are a helpful assistant.'],
    //        ['role' => 'user', 'content' => $prompt],
   //     ],
    //    'stream' => false,
   // ]);


        //$data = $response->json(); // json -> array
        //return $response->json();
        //return $data;

    //  return response()->json([
    //    'status' => 'ok',
     //   'message' => 'Postman is connected',
    //    'time' => now()->toDateTimeString(),
        
   // ]);

   return [
   'subtasks' => ['A', 'B', 'C']
];


        // 1️⃣ If OpenAI returned an error
        if (!isset($data['choices'][0]['message']['content'])) { //so is just digging down this tree to get that string(content).
            //choices are like diff versions of ans the ai can give, but we just look at the first one [0]
            return [];                                           
        }

        //message contains metadata
        //content is the actual ans AI gave, might be a good json format or might be hello..., bang talk rubbish  for wat

        $content = $data['choices'][0]['message']['content'];

        // 2️⃣ Extract JSON from text
        preg_match('/\{.*\}/s', $content, $matches); //This code acts like a filter. also matches here is like an empty container, it will store the json if he finds it
        // It ignores the "Sure! Here is..." text and hunts specifically for the { starting bracket and the } ending bracket.
        //if } is missing, it will return 0, and matches[0] wont even eb created

        if (!isset($matches[0])) { //return false if null 
            return []; // terus keluar here if its null
        }




        // 3️⃣ Decode JSON safely
        $decoded = json_decode($matches[0], true); // change json to array, use true so that it trans to array rather than collection obj
        //might return null or jsonResponse onj (error) too, if its an invalid json format

        return is_array($decoded) ? $decoded : []; // is this fr an actually array? true then return lo, if not then [] lo
    }
}

//dumb string json (preg_match)
//"{ "task": "Learn JSON", "status": "completed" }" $obj->attr

//smart array (json(), json_decode 
//['task' => 'Learn JSON', 'status' => 'completed'] arr[attr]