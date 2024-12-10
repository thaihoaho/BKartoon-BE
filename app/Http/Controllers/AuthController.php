<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Tìm người dùng dựa trên email
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Đăng nhập thành công!',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role, 
                'id' => $user->id,
            ],
        ], 200);
    }

        // Thất bại: trả về lỗi
        return response()->json([
            'message' => 'Sai email hoặc mật khẩu!',
        ], 401);
    }

    // Đăng ký người dùng mới
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
        ]);

        return response()->json([
            'message' => 'Đăng ký thành công!',
            'user' => $user,
        ], 201);
    }

    
}
