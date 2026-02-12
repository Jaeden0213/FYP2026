<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [ //only enables these attr to be mass assign, $request->all(), maybe hacker add some fields in the request form like admin = 1
        'name',
        'email',
        'password',
        'status',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function points()
    {
        return $this->hasMany(\App\Models\Point::class, 'user_id');
    }

    public function totalPoints(): int
    {
        return (int) $this->points()->sum('points_value'); // MUST match your DB column
    }

    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'user_id');
    }

    public function level(): int
    {
        return intdiv($this->totalPoints(), 100) + 1;
    }
    
}
