<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserCtrl@register');
Route::post('login', 'UserCtrl@login');
Route::post('changepass', 'UserCtrl@changePass');

Route::get('getAssignment', 'AssignmentCtrl@showApi');
Route::get('getAssignmentID/{id}', 'AssignmentCtrl@showApiID');

Route::get('getAsset', 'AssetCtrl@showApi');
Route::get('getAssetType/{type}', 'AssetCtrl@showApiType');
Route::get('getAssetByID/{id}', 'AssetCtrl@showApiByID');
Route::post('createAsset', 'AssetCtrl@createApi');
Route::post('updateAsset', 'AssetCtrl@updateApi');

Route::get('getHistory/{id}', 'AssignmentCtrl@showHistory');

Route::get('borrow/{id}', 'BorrowCtrl@showApiID');
Route::post('borrow', 'BorrowCtrl@store');
Route::post('return', 'ReturnCtrl@store');

Route::get('book', 'BookCtrl@book');

Route::post('sendTrackedLocation', 'TrackCtrl@sendTrackedLocation');
Route::get('getTrackedLocation/{id}', 'TrackCtrl@getTrackedLocation');

Route::get('bookall', 'BookCtrl@bookAuth')->middleware('jwt.verify');
Route::get('user', 'UserCtrl@getAuthenticatedUser')->middleware('jwt.verify');