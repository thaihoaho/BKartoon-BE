<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'film';
    protected $primaryKey = 'FILM_ID';   
    public $timestamps = false;       
    protected $fillable = [
        'FILM_Description ',
        'FILM_Title',
        'FILM_Type',
        'FILM_RatingLevel',
    ];
}

