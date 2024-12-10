<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelongsTo extends Model
{
    protected $table = 'belongs_to'; 
    public $timestamps = false; 

    protected $fillable = [
        'FILM_ID',
        'CATE_ID',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'FILM_ID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CATE_ID');
    }
}
