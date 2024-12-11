<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produce extends Model
{
    use HasFactory;

    protected $table = 'produce';

    protected $fillable = [
        'Start_day',
        'End_day',
        'Budget',
        'FILM_ID',
        'STU_ID'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'FILM_ID', 'FILM_ID');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'STU_ID', 'STU_ID');
    }

    
}
