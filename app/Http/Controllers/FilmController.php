<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return response()->json($films);
    }

    public function infoMovie($id)
    {
        $film = Film::find($id)->load('movie', 'series', 'filmDirectories', 'studio', 'categories', 'rating');

        $characters = Character::where('FILM_ID', $id)
            ->with('voiceActors')
            ->get();
        $film->character = $characters;

        if ($film->FILM_Type == "BO"){
            unset($film->movie);
        } else unset($film->series);

        $result = DB::select('SELECT CalculateFilmAverage(:id) AS AverageRating;', [
            'id' => $id
        ]);

        if (!empty($result)) {
            $point = $result[0]->AverageRating;
        } 
        $film->setAttribute('averageRating', $point);

        return response()->json($film);
    }

};
