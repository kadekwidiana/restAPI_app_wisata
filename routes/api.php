<?php

use App\Http\Controllers\API\AUTH\LoginController;
use App\Http\Controllers\API\AUTH\RegisterController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
// use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// login
Route::post('login', [LoginController::class, 'login']);
// register
Route::post('register', [RegisterController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Post
    Route::apiResource('posts', PostController::class);
    Route::post('/posts/{id}', [PostController::class, 'update']);

    // Category
    Route::apiResource('category', CategoryController::class);
    Route::post('category/{id}', [CategoryController::class, 'update']);
});
