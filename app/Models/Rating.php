<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    
    protected $table = 'rating';
    protected $fillable = [
        'Point',
        'Comment',
        'Date',
        'USER_Username',
        'FILM_ID',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'FILM_ID');
    }
}
