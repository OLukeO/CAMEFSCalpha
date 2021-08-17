<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/', [AuthController::class, 'guests_login']);
    Route::post('/', [AuthController::class, 'user_login']);
});

Route::middleware('api')->post('/logout', [AuthController::class, 'revoke_token']);


