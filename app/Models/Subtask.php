<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
     protected $fillable = [
        'task_id',
        'title',
        'description',
        'status',
        'points',

];

    public function task(){
        return $this->belongsTo(Task::class);
    } // laravel knows 2 things
    // 1. subtask is conn/child of Task
    //2. there is a foreign key in subtask called task_id(eloquent assump), and its pk is id for Task
    protected $table = 'subtasks';

    }

