<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\Controller;
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

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'item'], function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/{item}', [ItemController::class, 'show']);
        Route::post('/store', [ItemController::class, 'store']);
        Route::post('/update/{item}', [ItemController::class, 'update']);
        Route::post('/delete/{item}', [ItemController::class, 'destroy']);
    });
});

/**
 *  User Login
 */

Route::post('/login', [Controller::class, 'login']);
