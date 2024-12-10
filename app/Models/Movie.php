<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movie';
    protected $primaryKey = 'FILM_ID';
    public $timestamps = true;
    protected $fillable = [
        'MOV_Duration',
        'MOV_Release_day',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'FILM_ID');
    }
}
