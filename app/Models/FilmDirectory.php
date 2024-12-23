<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmDirectory extends Model
{
    use HasFactory;

    protected $table = 'film_directory';

    protected $primaryKey = 'DIC_ID';

    public $timestamps = true;

    protected $fillable = [
        'DIC_Nationality',
        'DIC_YearOfBirth',
        'FName',
        'MName',
        'LName',
    ];

    public function directedFilms()
    {
        return $this->hasMany(Direct::class, 'DIC_ID', 'DIC_ID');
    }
}
