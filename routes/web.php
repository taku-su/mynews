<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function(){
    Route::get('news/create', 'Admin\NewController@add');
    Route::get('profile/create','Admin\ProfileController@add');
Route::get('profile/edit','Admin\ProfileController@edit');
});
//課題9
Route::get('XXX','AAAController@bbb');
Route::get(['prefix' => 'profile'], function(){
Route::get('create','ProfileController@add');
Route::get('edit','ProfileController@edit');
});

