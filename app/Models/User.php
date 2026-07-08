<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Event yang dibuat oleh user
     */
    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

    /**
     * Event yang diikuti user
     */
    public function joinedEvents()
    {
        return $this->belongsToMany(Event::class, 'participants')
                    ->withPivot('attendance_status')
                    ->withTimestamps();
    }
}