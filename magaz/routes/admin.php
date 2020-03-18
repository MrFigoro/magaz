<?php

//Auth::routes();
Route::get('/loginform', 'AuthController@showLoginForm')->name('login');
Route::post('/signin', 'AuthController@login')->name('signin');
Route::post('/logout', 'AuthController@logout')->name('logout')->middleware('auth');

Route::get('/', 'UserController@index')->name('index')->middleware('auth');
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');
Route::get('/users/active/{id}', 'UserController@active')->name('usersActive')->middleware('auth');
Route::post('/users', 'UserController@search')->name('usersSearch')->middleware('auth');
Route::get('/users/create', 'UserController@create')->name('usersCreate')->middleware('auth');
Route::post('/users/store', 'UserController@store')->name('usersSave')->middleware('auth');
Route::get('/users/edit/{id?}', 'UserController@edit')->name('usersEdit')->middleware('auth');
Route::get('/users/delete/{id}', 'UserController@destroy')->name('usersDelete')->middleware('auth');