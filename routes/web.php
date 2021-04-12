<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('track/{id}', 'TrackCtrl@show');
Route::get('trackID/{id}', 'TrackCtrl@showTracker');

Route::get('location', 'LocationCtrl@show');
Route::post('location', 'LocationCtrl@store');
Route::post('location/update', 'LocationCtrl@update');
Route::post('location/delete', 'LocationCtrl@delete');

Route::get('assignment', 'AssignmentCtrl@show');
Route::post('assignment', 'AssignmentCtrl@store');
Route::post('assignment/update', 'AssignmentCtrl@update');
Route::post('assignment/delete', 'AssignmentCtrl@delete');

Route::get('asset', 'AssetCtrl@show');
Route::post('asset', 'AssetCtrl@store');
Route::post('asset/update', 'AssetCtrl@update');
Route::post('asset/delete', 'AssetCtrl@delete');

Route::get('report', 'ReportCtrl@show');

Route::get('user', 'UserCtrl@show');
Route::post('user', 'UserCtrl@store');
Route::post('user/update', 'UserCtrl@update');