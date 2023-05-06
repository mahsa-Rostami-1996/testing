<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\ImageController;

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
Route::get('/login', [UserController::class, 'login']);
Route::get('/signup', [UserController::class, 'signup']);

Route::post('/images', [ImageController::class, 'store']);
Route::get('/images/{id}', [ImageController::class, 'show']);
Route::delete('/images/{id}', [ImageController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user/logout', function ($id){
    request()->user()->tokens()->where('id', $id)->delete();
    return response([], 204);
});
