<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [ //klm mn yg blh diisi
        'name',
        'email',
        'role',
        'password',
        'status',
    ];

    protected $hidden = [ //biar ga keliatan
        'password',
        'remember_token',
    ];

    protected function casts(): array //ngubh tipe data
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function createdEvents()
    {
        return $this->hasMany(Event::class, 'user_id'); //1user bisa bikin bnyk event
    }

    
    public function joinedEvents()
    {
        return $this->belongsToMany(Event::class, 'participants')
                    ->withPivot('attendance_status')
                    ->withTimestamps();
    }
}