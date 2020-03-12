<?php


Route::get('/', 'UserController@index')->name('index')->middleware('auth');