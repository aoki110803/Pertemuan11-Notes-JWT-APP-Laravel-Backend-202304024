<?php
 
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Support\Facades\Route;
 
// ── Public routes (tanpa auth) ────────────────────────────────
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
 
// ── Protected routes (wajib login / JWT valid) ────────────────
Route::middleware('auth:api')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me',       [AuthController::class, 'me']);
 
    // CRUD catatan
    Route::apiResource('notes', NoteController::class);
});
