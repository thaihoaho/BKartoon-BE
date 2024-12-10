<?php

use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmDirectoryController;
use App\Http\Controllers\PostController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\StudioController;

use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'get']);
Route::post('addfilm', [ProcedureController::class, 'callAddFilmProcedure']);


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('ranking', [ProcedureController::class, 'callGetFilmsByCategory']);

Route::get('director', [FilmDirectoryController::class, 'index']);
Route::get('director/name', [FilmDirectoryController::class, 'name']);
Route::get('studio/name', [StudioController::class, 'name']);

Route::get('movie/{id}', [FilmController::class, 'infoMovie']);

