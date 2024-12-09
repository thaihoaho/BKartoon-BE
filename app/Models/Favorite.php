<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    //
    use HasFactory;
    protected $table = 'favorite_list';
    protected $primaryKey = 'FAV_ID'; 
    public $timestamps = false; 
    protected $fillable = ['FAV_Count', 'FAV_Name', 'FAV_Follower', 'USER_ID'];

    public function user()
    {
        return $this->belongsTo(User1::class, 'User_ID');
    }
}
