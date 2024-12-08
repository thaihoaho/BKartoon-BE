<?php

use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmDirectoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\UserProfileController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\StudioController;

use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'get']);
Route::post('addfilm', [ProcedureController::class, 'callAddFilmProcedure']);
Route::post('addfilm2', [ProcedureController::class, 'addFilm']);
Route::delete('deletefilm', [ProcedureController::class, 'deleteFilm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('ranking', [ProcedureController::class, 'callGetFilmsByCategory']);

Route::get('director', [FilmDirectoryController::class, 'index']);
Route::get('director/name', [FilmDirectoryController::class, 'name']);
Route::get('studio/name', [StudioController::class, 'name']);

Route::get('films', [FilmController::class, 'index']);

Route::get('user-profile/{userId}', [UserProfileController::class, 'getUserProfile']);

Route::post('toggle-follow', [ProcedureController::class, 'toggleFollow']);