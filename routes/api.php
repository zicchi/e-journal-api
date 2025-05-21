<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeachingScheduleController;
use App\Http\Controllers\DailyNoteController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [TeacherController::class, 'profile']);
    Route::get('/schedule', [TeachingScheduleController::class, 'index']);

    Route::get('/notes', [DailyNoteController::class, 'index']);
    Route::post('/notes', [DailyNoteController::class, 'store']);
    Route::get('/notes/{id}', [DailyNoteController::class, 'show']);
    Route::post('/notes/{id}/media', [DailyNoteController::class, 'uploadMedia']);
    Route::delete('/logout', [AuthController::class, 'logout']);
});
