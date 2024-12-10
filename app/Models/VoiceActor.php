<?php

// app/Models/VoiceActor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceActor extends Model
{
    protected $table = 'voice_actor';
    protected $primaryKey = 'VOI_ID';
    public $timestamps = true;
    protected $fillable = [
        'FName',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'dubbing', 'VOI_ID', 'FILM_ID');
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'dubbing', 'VOI_ID', 'CHA_Name');
    }
}
