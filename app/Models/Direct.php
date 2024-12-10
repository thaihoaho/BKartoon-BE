<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direct extends Model
{
    use HasFactory;

    protected $table = 'direct';

    public $timestamps = false;

    protected $fillable = [
        'Start_day',
        'End_day',
        'FILM_ID',
        'DIC_ID',
    ];

    public function filmDirectory()
    {
        return $this->belongsTo(FilmDirectory::class, 'DIC_ID', 'DIC_ID');
    }
    public function film()
    {
        return $this->belongsTo(Film::class, 'FILM_ID', 'FILM_ID');
    }
}
