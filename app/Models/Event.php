<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poster',
        'movie_title',
        'genre',
        'duration',
        'release_year',
        'synopsis',
        'event_name',
        'event_date',
        'event_time',
        'description',
    ];

    /**
     * User yang membuat event
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Peserta yang mengikuti event
     */
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')
                    ->withPivot('attendance_status')
                    ->withTimestamps();
    }
}