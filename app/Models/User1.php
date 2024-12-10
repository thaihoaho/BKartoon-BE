<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User1 extends Model
{
    //
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id'; 
    public $timestamps = false; 
    protected $fillable = ['name', 'email', 'password', 'reputation_score'];

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'User_ID');
    } 
}
