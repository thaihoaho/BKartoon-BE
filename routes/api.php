<?php

use App\Http\Controllers\Api\ProcedureController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('posts', [PostController::class, 'get']);
Route::post('addfilm', [ProcedureController::class, 'callAddFilmProcedure']);
