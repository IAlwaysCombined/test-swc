<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\EventController;
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

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/registration', [AuthController::class, 'registration']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });

    Route::middleware('auth:api')->group(function () {
        Route::prefix('/event')->group(function () {
            Route::post('/add/to/event/{id}', [EventController::class, 'addToEvent']);
            Route::post('/remove/from/event/{id}', [EventController::class, 'removeFormEvent']);
        });
        Route::apiResource('/event', EventController::class);
    });

});
