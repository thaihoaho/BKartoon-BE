<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\User1;
use App\Models\Favorite;


class UserProfileController extends Controller
{
    public function getUserProfile($userId)
    {
        $user = User1::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Lấy danh sách favorites liên quan đến user
        $favorites = $user->favorites;

        // Trả về thông tin người dùng + danh sách yêu thích
        return response()->json([
            'user_id' => $user->id,
            'username' => $user->name,
            'joinDate' => $user->created_at,
            'reputationScore' => $user->reputation_score,
            'favoriteLists' => $favorites->map(function ($item) {
                return [
                    'id' => $item->FAV_ID,
                    'name' => $item->FAV_Name,
                    'movieCount' => $item->FAV_Count,
                    'followerCount' => $item->FAV_Follower,
                    'user_id' => $item->USER_ID,
                ];
            })
        ]);
    }
}
