<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class ProcedureController extends Controller
{   
    public function addRating(Request $request)
{
    try {
        // Lấy các giá trị từ request
        $userId = $request->input('user_id', null);
        $filmId = $request->input('film_id', null);
        $point = $request->input('point', null);
        $comment = $request->input('comment', '');
        // Thực hiện gọi thủ tục AddRating
        $result = DB::select("
            CALL AddOrUpdateRating(
                :user_id,
                :film_id,
                :point,
                :comment
            )", [
            'user_id' => $userId,
            'film_id' => $filmId,
            'point' => $point,
            'comment' => $comment,
        ]);

        // Trả về kết quả thành công
        return response()->json([
            'error' => false,
            'message' => $result,

        ]);
    } catch (QueryException $e) {
        // Xử lý lỗi từ cơ sở dữ liệu
        $fullMessage = $e->getMessage();
        preg_match('/\d{4} (.+?)\./', $fullMessage, $matches);
        $readableMessage = $matches[1] ?? 'An unknown error occurred.';
        if (strpos($readableMessage, 'Rating ') !== false) {
                return response()->json([
                    'error' => false,
                    'message' => 'Rating trước kia của bạn đã được cập nhật lại.',
                ]);
        }
        return response()->json([
            'error' => true,
            'message' => $readableMessage,
        ], 500);
    }
}
    public function callAddFilmProcedure(Request $request)
    {
        try {
            $description = $request->input('description', '');
            $title = $request->input('title', '');
            $type = $request->input('type', '');
            $duration = $type === 'LE' ? $request->input('duration', null) : null;
            $releaseDate = $type === 'LE' ? $request->input('releaseDate', null) : null;
            $episodes = $type === 'BO' ? $request->input('episodes', null) : null;
            $directors = $request->input('directors', null);
            $studios = $request->input('studios', null);

            $result = DB::select("
                CALL AddFilm2(
                    :description, 
                    :title, 
                    :type, 
                    :duration, 
                    :releaseDate, 
                    :episodes, 
                    :directors, 
                    :studios
                )", [
                'description' => $description,
                'title' => $title,
                'type' => $type,
                'duration' => $duration,
                'releaseDate' => $releaseDate,
                'episodes' => $episodes,
                'directors' => $directors,
                'studios' => $studios,
            ]);
    
            return response()->json([
                'error' => false,
                'message' => $result,
            ]);
        } catch (QueryException $e) {

            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\!/', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'An unknown error occurred.';
    
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function addFilm(Request $request)
    {
        try {
            $title = $request->input('title', '');
            $description = $request->input('description', '');
            $type = $request->input('type', '');
            $duration = $type === 'LE' ? $request->input('duration', null) : null;
            $releaseDate = $type === 'LE' ? $request->input('releaseDate', null) : null;
            $episodes = $type === 'BO' ? $request->input('episodes', null) : null;

            $result = DB::select("
                CALL AddFilm(
                    :title,
                    :description, 
                    :type, 
                    :duration, 
                    :releaseDate, 
                    :episodes
                )", [
                'title' => $title,
                'description' => $description,
                'type' => $type,
                'duration' => $duration,
                'releaseDate' => $releaseDate,
                'episodes' => $episodes,
            ]);
            return response()->json([
                'error' => false,
                'message' => $result,
            ]);
        } catch (QueryException $e) {
            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\!/', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'An unknown error occurred.';
    
            return response()->json([
                'error' => true,
                'message' => $readableMessage,
            ], 500);
        }
    }

    public function deleteFilm(Request $request)
    {
        try {
            $filmId = $request->input('filmId'); // Lấy Film ID từ request

            $result = DB::select("
                CALL DeleteFilm(
                    :filmId
                )", [
                'filmId' => $filmId,
            ]);

        return response()->json([
            'error' => false,
            'message' => $result,
        ]);
        } catch (QueryException $e) {
            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\!/', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'Đã xảy ra lỗi khi xóa phim.';

            return response()->json([
                'error' => true,
                'message' => $readableMessage,
            ], 500);    
        } 
    }
    public function updateFilm(Request $request)
    {
        try {
            $filmId = $request->input('filmId'); // Lấy Film ID từ request
            $title = $request->input('title', '');
            $description = $request->input('description', '');
            $result = DB::select("
                CALL UpdateFilm(
                    :filmId,
                    :title,
                    :description
                )", [
                'filmId' => $filmId,
                'title' => $title,
                'description' => $description,
            ]);
        return response()->json([
            'error' => false,
            'message' => $result,
        ]);
        } catch (QueryException $e) {
            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\!/', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'Đã xảy ra lỗi khi xóa phim.';

            return response()->json([
                'error' => true,
                'message' => $readableMessage,
            ], 500);    
        } 
    }

    public function callGetFilmsByCategory(Request $request)
    {
        try {
            $categoryName = $request->input('category_name', NULL);

            $result = DB::select("CALL GetFilmsByCategory(:category_name);", [
                'category_name' => $categoryName,
            ]);
            

            return response()->json([
                'error' => false,
                'message' => $result,
            ]);
        } catch (QueryException $e) {

            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\!/', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'An unknown error occurred.';

            return response()->json([
                'error' => true,
                'message' => $readableMessage,
            ], 500);
        }
    }

    public function toggleFollow(Request $request)
    {
        $validated = $request->validate([
            'sharer_id' => 'required|integer',
            'shared_id' => 'required|integer',
            'fav_id' => 'required|integer',
        ]);

        $sharer_id = $validated['sharer_id'];
        $shared_id = $validated['shared_id'];
        $fav_id = $validated['fav_id'];

        try {

            $result = DB::select('CALL ToggleShare(?, ?, ?)', [
                $sharer_id,
                $shared_id,
                $fav_id,
            ]);

            return response()->json([
                'error' => false,
                'message' => $result,
            ]);
        } catch (QueryException $e) {

            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\!/', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'An unknown error occurred.';

            if (strpos($readableMessage, 'Followed successfully') !== false) {
                return response()->json([
                    'error' => false,
                    'message' => 'Followed successfully',
                ]);
            }
            if (strpos($readableMessage, 'Unfollowed successfully') !== false) {
                return response()->json([
                    'error' => false,
                    'message' => 'Unfollowed successfully',
                ]);
            }
    
            return response()->json([
                'error' => true,
                'message' => $readableMessage,
            ], 500);
        }
    }

    public function addCategory(Request $request)   {
        try {
        $filmId = $request->input('filmId'); 
        $name = $request->input('name', '');
        $description = $request->input('description', '');
        $result = DB::select("
                CALL AddCategoryAndLinkToFilm(
                    :filmId,
                    :name,
                    :description
                )", [
                'filmId' => $filmId,
                'name' => $name,
                'description' => $description,
            ]);
            return response()->json([
            'error' => false,
            'message' => $result,
        ]);
        } catch (QueryException $e) {
            $fullMessage = $e->getMessage();
            preg_match('/\d{4} (.+?)\./', $fullMessage, $matches);
            $readableMessage = $matches[1] ?? 'Đã xảy ra lỗi không xác định.';

            return response()->json([
                'error' => true,
                'message' => $readableMessage,
            ], 500);  
        }
    }
    public function addCharacter(Request $request)
    {
    try {
        // Lấy dữ liệu từ request
        $filmId = $request->input('filmId'); 
        $characterName = $request->input('name', '');
        $characterSex = $request->input('sex', '');

        // Gọi stored procedure để thêm nhân vật
        $result = DB::select("
            CALL AddCharacter(
                :filmId,
                :characterName,
                :characterSex
            )", [
            'filmId' => $filmId,
            'characterName' => $characterName,
            'characterSex' => $characterSex,
        ]);

        // Trả về JSON nếu thành công
        return response()->json([
            'error' => false,
            'message' => $result,
        ]);
    } catch (QueryException $e) {
        // Lấy thông báo lỗi dễ đọc từ exception
        $fullMessage = $e->getMessage();
        preg_match('/\d{4} (.+?)\./', $fullMessage, $matches);
        $readableMessage = $matches[1] ?? 'Đã xảy ra lỗi không xác định.';

        // Trả về JSON nếu có lỗi
        return response()->json([
            'error' => true,
            'message' => $readableMessage,
        ], 500);
        }
    }


}    