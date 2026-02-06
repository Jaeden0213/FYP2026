<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'priority',
        'status',
        'assignee',
        'due_date',
        'points',
        'start_time',
        'end_time',

];

    public function user(){
        return $this->belongsTo(User::class); // return $this->belongsTo(User::class, 'owner_id'); if u didnt fllw naming conven
    }

    public function subtasks(){
    return $this->hasMany(Subtask::class);
    }

}


