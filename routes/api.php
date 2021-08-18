<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SafewayController;
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

//Route::get('/user', function (Request $request) {
//    return $request;
//});

Route::prefix('login')->middleware('api')->group(function(){
    Route::post('/tourist', [AuthController::class, 'tourist_login']);
    Route::post('/user', [AuthController::class, 'user_login']);
});

Route::middleware('api')->post('/logout', [AuthController::class, 'revoke_token']);

Route::prefix('monitor')->middleware('api')->group(function (){
    Route::post('/start', [SafewayController::class, 'start_monitor']);
    Route::post('/end', [SafewayController::class, 'end_monitor']);
    Route::post('/sos', [SafewayController::class, 'sos']);
});
