<?php
// app/Models/Dubbing.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dubbing extends Model
{
    protected $table = 'dubbing';
    public $timestamps = true;
    protected $fillable = [
        'Language',
        'FILM_ID',
        'CHA_Name',
        'VOI_ID',
    ];
}
