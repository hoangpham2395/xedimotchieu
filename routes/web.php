<?php

Route::get('/', function () {
    return view('layouts.backend.structure.main');
});

Route::prefix('management')->group(function () {
	Route::get('login', 'Auth\LoginController@getLogin');
	Route::post('login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@postLogin']);
	Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);

	Route::middleware(['isAdmin'])->group(function () {
		Route::get('dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
		Route::get('/', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
		Route::resource('admin', 'Backend\AdminController');
		Route::resource('users', 'Backend\UsersController');
	});
});