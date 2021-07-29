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

##redirect to login first
Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();

##route to log out the user
Route::get('logout','Auth\LoginController@logout');

##authenticated middleware
Route::group(['middleware' => ['auth']], function () { 
Route::resource('list','ListController');
Route::resource('task','TaskController');
Route::resource('user','UserController');
});

