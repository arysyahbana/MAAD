<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiAuthenticationController;
use App\Http\Controllers\Api\ApiMediaController;
use App\Http\Controllers\Frontend\FrontPremiumController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('posts/show/{id}/{name}', [FrontPostController::class, 'show'])->name('post_show')->middleware('auth');
// Route::get('/tes', function () {
//     dd('test api');
// });

//user show
Route::get('/user/index', [ApiPostController::class, 'index']);
Route::get('/user/show/{id}', [ApiPostController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    //user
    Route::get('/user/data-user', [ApiUserController::class, 'user']);
    Route::patch('/user/update-user/{id}', [ApiUserController::class, 'update_user']);

    //post
    Route::post('/user/store', [ApiPostController::class, 'store']);
    Route::patch('/user/update/{id}', [ApiPostController::class, 'update']);
    Route::delete('/user/delete/{id}', [ApiPostController::class, 'delete']);

    //media
    Route::get('/user/media/{id}', [ApiMediaController::class, 'show']);
});

//login dkk
Route::post('/signup', [ApiAuthenticationController::class, 'signup']);
Route::get('/signup/{token}/{email}', [ApiAuthenticationController::class, 'verif']);
Route::post('/login', [ApiAuthenticationController::class, 'login']);
Route::get('/logout', [ApiAuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/me', [ApiAuthenticationController::class, 'me'])->middleware(['auth:sanctum']);

//midtrans
Route::post('/user/callback', [FrontPremiumController::class, 'callback'])->name('callback');
