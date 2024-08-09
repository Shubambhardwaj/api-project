<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EncryptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes for user registration and login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::post('articles', [ArticleController::class, 'store']);
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('article/{id}', [ArticleController::class, 'show']);
    Route::put('article/{id}', [ArticleController::class, 'update']);
    Route::delete('article/{id}', [ArticleController::class, 'destroy']);
    
    // Encryption/Decryption endpoints
    Route::post('encrypt', [EncryptionController::class, 'encrypt']);
    Route::post('decrypt', [EncryptionController::class, 'decrypt']);
});
