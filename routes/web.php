<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/', [Controllers\AuthController::class, 'admin_login']);
Route::post('/', [Controllers\AuthController::class, 'do_admin_login']);
Route::middleware('auth:sanctum')->get('/home', [Controllers\SafewayController::class, 'show']);
