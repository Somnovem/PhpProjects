<?php

use App\Http\Controllers\Jwt\JwtLoginController;
use App\Http\Controllers\PhotoCategoryController;
use App\Http\Controllers\PhotoController;
use \App\Http\Controllers\PhotoTagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/jwt/login',[JwtLoginController::class,'login']);
Route::get('/jwt/me',[JwtLoginController::class,'me'])->middleware('auth:api');

Route::apiResource('photo', PhotoController::class)->middleware('auth:api');
Route::apiResource('photo_category', PhotoCategoryController::class);
Route::apiResource('photo_tag', PhotoTagController::class);
