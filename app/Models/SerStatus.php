<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerStatus extends Model
{
    use HasFactory;

    protected $table = 'ser_status';
    protected $primaryKey = 'FILM_ID';
    public $incrementing = false;
    protected $fillable = [
        'FILM_ID',
        'Modified_date',
        'Status',
    ];
    public $timestamps = false;

    public function filmSeries()
    {
        return $this->belongsTo(FilmSeries::class, 'FILM_ID', 'FILM_ID');
    }
}
