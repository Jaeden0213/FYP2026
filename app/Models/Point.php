<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $primaryKey = 'points_id';

    protected $fillable = [
        'points_value',
        'level',
        'description',
        'source_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


