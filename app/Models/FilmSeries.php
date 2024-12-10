<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmSeries extends Model
{
    use HasFactory;

    protected $table = 'film_series';
    protected $primaryKey = 'FILM_ID';
    public $incrementing = false;
    protected $fillable = [
        'FILM_ID',
        'SER_Number_of_episodes',
    ];
    public $timestamps = false;

    public function serStatus()
    {
        return $this->hasOne(SerStatus::class, 'FILM_ID', 'FILM_ID');
    }
}
