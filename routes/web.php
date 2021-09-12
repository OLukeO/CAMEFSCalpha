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

Route::resource('places', 'App\Http\Controllers\PlaceController');
Route::resource('photos', 'App\Http\Controllers\PhotoController');
Route::resource('beacons', 'App\Http\Controllers\IbeaconController');

Route::get('/', [Controllers\AuthController::class, 'admin_login']);
Route::post('/home', [Controllers\AuthController::class, 'do_admin_login']);
Route::get('/home', [Controllers\SafewayController::class, 'show']);

Route::resource('peoples', 'App\Http\Controllers\PeopleController');

Route::post('chartjs', [Controllers\ChartJsController::class, 'index'])->name('chartjs.index');
Route::get('chartjs', [Controllers\ChartJsController::class, 'index'])->name('chartjs.index');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
