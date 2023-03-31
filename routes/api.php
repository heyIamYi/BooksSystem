<?php

use App\Http\Controllers\ItemController;
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

Route::group(['prefix' => 'item'], function () {
    Route::get('/', [ItemController::class, 'index']);
    Route::get('/show/{item}', [ItemController::class, 'show']);
    Route::post('/store', [ItemController::class, 'store']);
    Route::post('/update/{item}', [ItemController::class, 'update']);
    Route::post('/delete/{item}', [ItemController::class, 'destroy']);
});
