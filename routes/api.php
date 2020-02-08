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

Route::resource('Category', 'CategoryController')->except([ 'create', 'edit']);
Route::resource('User', 'UserController')->except([ 'create', 'edit']);
Route::resource('Post', 'PostController')->except([ 'create', 'edit']);

