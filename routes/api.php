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

/**
 * All Auth related routes
 */
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

/**
 * All User related routes
 */
Route::group([
    'middleware' => 'auth:api', 
    'prefix' => 'user'
], function ($router) {
    Route::get('me', 'UserController@me');
    Route::put('update', 'UserController@updateUser');
});

/**
 * Fallback Route 
 */
Route::fallback(function () {
    return response()->json(['error' => 'Not Found!'], 404);
});
