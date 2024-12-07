<?php

use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'get']);
Route::post('addfilm', [ProcedureController::class, 'callAddFilmProcedure']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);