<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; 
    protected $primaryKey = 'CATE_ID';
    public $timestamps = false; 

    protected $fillable = [
        'CATE_Description',
        'CATE_Name',
    ];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'belongs_to', 'CATE_ID', 'FILM_ID');
    }
}
