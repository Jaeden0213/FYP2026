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

];

    public function user(){
        return $this->belongsTo(User::class); // return $this->belongsTo(User::class, 'owner_id'); if u didnt fllw naming conven
    }

}


