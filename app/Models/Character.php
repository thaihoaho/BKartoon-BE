<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'characters';
    protected $primaryKey = 'CHA_Name';

    public $incrementing = false;
    protected $keyType = 'string';

    public $timestamps = true;
    protected $fillable = [
        'CHA_Name',
        'CHA_Sex',
        'FILM_ID',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'FILM_ID');
    }

    public function voiceActors()
    {
        return $this->belongsToMany(VoiceActor::class, 'dubbing', 'CHA_Name', 'VOI_ID');
    }
}
