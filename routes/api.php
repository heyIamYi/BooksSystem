<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    $response = Http::withHeaders([
        'Authorization' => 'Bearer '. $token,
    ]);

    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
// Route::apiResource('item', ItemController::class);

Route::group(['prefix' => 'item'], function () {

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('/store', [ItemController::class, 'store']);
        Route::post('/update/{item}', [ItemController::class, 'update']);
        Route::post('/delete/{item}', [ItemController::class, 'destroy']);
    });

    Route::get('/', [ItemController::class, 'index']);
    Route::get('/show/{item}', [ItemController::class, 'show']);

});
