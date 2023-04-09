<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TodoController;
//ユーザー認証周り
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todo/show', [TodoController::class, 'show']);

//ユーザー認証周り
Route::post('/auth/register', [RegisterController::class, 'regist']);
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/auth/logout', [LogoutController::class, 'logout'])->middleware('auth:sanctum');
