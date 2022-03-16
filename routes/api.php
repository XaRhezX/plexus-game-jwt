<?php

use App\Http\Controllers\API\Auth\ChangePasswordController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\PasswordResetRequestController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CoinController;
use App\Http\Controllers\API\ExperienceController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\HitStatController;
use App\Http\Controllers\API\LeaderboardController;
use App\Http\Controllers\API\ProfileController;
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


Route::middleware('jwt.log')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', [RegisterController::class, 'handle']);
        Route::post('login', [LoginController::class, 'handle']);
        Route::post('reset-password', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
        Route::post('change-password', [ChangePasswordController::class, 'passwordResetProcess']);

        Route::group(['middleware' => ['jwt.verify']], function () {
            Route::post('logout', [LogoutController::class, 'handle'])->middleware('jwt.refresh');
        });
    });

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::get('me', [UserController::class, 'show']);
        Route::post('profile', [ProfileController::class, 'store']);

        Route::get('coin', [CoinController::class, 'show']);
        Route::post('coin', [CoinController::class, 'store']);

        Route::get('experience', [ExperienceController::class, 'show']);
        Route::post('experience', [ExperienceController::class, 'store']);

        Route::get('game', [GameController::class, 'index']);
        Route::get('game/{game}', [GameController::class, 'show']);

        Route::prefix('leaderboard')->group(function () {
            Route::get('experience', [LeaderboardController::class, 'getLeaderboardExp']);
            Route::get('experience/by-game', [LeaderboardController::class, 'getLeaderboardExpByGame']);

            Route::get('coin', [LeaderboardController::class, 'getLeaderboardCoin']);
            Route::get('coin/by-game', [LeaderboardController::class, 'getLeaderboardCoinByGame']);
        });

        Route::prefix('statistic')->group(function () {
            Route::get('last-day', [HitStatController::class, 'lastDay']);
            Route::get('last-week', [HitStatController::class, 'lastWeek']);
            Route::get('last-month', [HitStatController::class, 'lastMonth']);
        });
    });
});
