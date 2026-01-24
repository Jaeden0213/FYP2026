<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model
{
    protected $fillable = [
        'user_id',
        'description',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class); // return $this->belongsTo(User::class, 'owner_id'); if u didnt fllw naming conven
    }
}

