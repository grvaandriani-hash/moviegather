<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //  tabel yang boleh diisi pas anambahin sama edit
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

    // Relasi Event sama User
    // Satu Event dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // event pnya bnk peserta
    public function participants()
    {
        return $this->belongsToMany(User::class, 'participants')

                  
                    ->withPivot('attendance_status')

                  
                    ->withTimestamps();
    }
}