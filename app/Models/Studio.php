<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    protected $table = 'studio';

    protected $fillable = ['STU_Name'];

    protected $primaryKey = 'STU_ID';

    public function films()
    {
        return $this->hasManyThrough(Film::class, Produce::class, 'STU_ID', 'FILM_ID', 'STU_ID', 'FILM_ID');
    }

    public function produces()
{
    return $this->hasMany(Produce::class, 'STU_ID', 'STU_ID');
}
}
