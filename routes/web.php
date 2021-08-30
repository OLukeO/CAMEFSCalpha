<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/123', function () {
    return view('attract.create');
});*/
Route::resource('456', 'App\Http\Controllers\InterfaceloginController');

Route::get('/', [Controllers\AuthController::class, 'admin_login']);
Route::post('/map', [Controllers\AuthController::class, 'do_admin_login']);
Route::middleware('auth:sanctum')->get('/home', [Controllers\SafewayController::class, 'show']);
