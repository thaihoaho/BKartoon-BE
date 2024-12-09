<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


class ProcedureController extends Controller
{
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
}    