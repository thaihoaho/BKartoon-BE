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

    public function movie()
    {
        return $this->hasOne(Movie::class, 'FILM_ID');
    }

    public function series()
    {
        return $this->hasOne(FilmSeries::class, 'FILM_ID')->with('serStatus');; 
    }

    public function characters()
    {
        return $this->hasMany(Character::class, 'FILM_ID');
    }
    public function directors()
    {
        return $this->hasMany(Direct::class, 'FILM_ID', 'FILM_ID');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'belongs_to', 'FILM_ID', 'CATE_ID');
    }

    public function voiceActors()
    {
        return $this->hasManyThrough(VoiceActor::class, Dubbing::class, 'FILM_ID', 'VOI_ID', 'FILM_ID', 'VOI_ID');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'FILM_ID');
    }

    public function filmDirectories()
    {
        return $this->hasManyThrough(
            FilmDirectory::class,
            Direct::class,
            'FILM_ID',
            'DIC_ID',
            'FILM_ID',
            'DIC_ID'
        );
    }
    public function studio()
    {
        return $this->belongsToMany(Studio::class, 'produce', 'FILM_ID', 'STU_ID');
    }
}
