<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return ':)';
});
 
Route::post('auth/login', 'Auth\UserController@login');
Route::post('auth/register', 'Auth\UserController@register');
 
Route::group(['middleware' => 'auth:api'], function () {
    // AUTH
    Route::get('auth/logout', 'Auth\UserController@logout');
    Route::get('auth/user', 'Auth\UserController@details');
    
    // APP
});
