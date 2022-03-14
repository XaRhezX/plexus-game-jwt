<?php

use App\Http\Controllers\API\Auth\ChangePasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\PasswordResetRequestController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::prefix('auth')->group(function(){
    Route::post('register', [RegisterController::class,'handle']);
    Route::post('login', [LoginController::class, 'handle']);
    Route::post('reset-password', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
    Route::post('change-password', [ChangePasswordController::class, 'passwordResetProcess']);

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::post('logout', [LogoutController::class, 'handle'])->middleware('jwt.refresh');
        Route::post('me', [UserController::class, 'show']);
    });
});
