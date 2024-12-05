<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Nếu bạn có các trường được phép thêm, sử dụng $fillable
    protected $fillable = ['title', 'content'];

    // Hoặc bảo vệ các trường không được phép thêm
    // protected $guarded = [];
}
