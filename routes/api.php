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
// Route::post('addfilm', [ProcedureController::class, 'callAddFilmProcedure']);
Route::post('addfilm2', [ProcedureController::class, 'addFilm']);
Route::post('addcategory', [ProcedureController::class, 'addCategory']);

Route::post('addcharacter', [ProcedureController::class, 'addCharacter']);

Route::post('updateFilm', [ProcedureController::class, 'updateFilm']);

Route::delete('deletefilm', [ProcedureController::class, 'deleteFilm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('ranking', [ProcedureController::class, 'callGetFilmsByCategory']);

Route::get('director', [FilmDirectoryController::class, 'index']);
Route::get('director/name', [FilmDirectoryController::class, 'name']);

Route::get('studio', [StudioController::class, 'index']);
Route::get('studio/name', [StudioController::class, 'name']);
Route::get('studio/{id}', [StudioController::class, 'info']);
Route::get('studio/budget/{studioName}/{year}', [StudioController::class, 'getStudioBudget']);

Route::get('movie/{id}', [FilmController::class, 'infoMovie']);

Route::get('user-profile/{userId}', [UserProfileController::class, 'getUserProfile']);
Route::get('films', [FilmController::class, 'index']);

Route::post('toggle-follow', [ProcedureController::class, 'toggleFollow']);
Route::post('addrating', [ProcedureController::class, 'addRating']);
Route::post('adddirect', [ProcedureController::class, 'addToDirect']);
Route::post('addproduce', [ProcedureController::class, 'addToProduce']);