<?php

use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmDirectoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'get']);
Route::post('addfilm', [ProcedureController::class, 'callAddFilmProcedure']);
Route::get('getfilmbycate', [ProcedureController::class, 'callGetFilmProcedure']);

Route::get('director', [FilmDirectoryController::class, 'index']);
Route::get('director/name', [FilmDirectoryController::class, 'name']);
Route::get('studio/name', [StudioController::class, 'name']);

Route::get('films', [FilmController::class, 'index']);