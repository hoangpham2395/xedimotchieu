<?php
// Frontend
Route::get('/', ['as' => 'home.index', 'uses' => 'Frontend\HomeController@index']);
Route::get('login', 'Frontend\Auth\LoginController@getLogin');
Route::post('login', ['as' => 'frontend.login', 'uses' => 'Frontend\Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'frontend.logout', 'uses' => 'Frontend\Auth\LoginController@logout']);
Route::get('register', 'Frontend\Auth\RegisterController@getRegister');
Route::post('register', ['as' => 'frontend.register', 'uses' => 'Frontend\Auth\RegisterController@postRegister']);
Route::middleware(['isLoginFrontend'])->group(function() {
	Route::prefix(getFrontendAlias())->group(function() {
		Route::resource('users', 'Frontend\UsersController')->only('edit', 'update')->names('frontend.users');
	});
});

// Backend
Route::prefix(getBackendAlias())->group(function () {
	Route::get('login', 'Auth\LoginController@getLogin');
	Route::post('login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@postLogin']);
	Route::get('logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);

	Route::middleware(['isAdmin'])->group(function () {
		Route::get('dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
		Route::get('/', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
		Route::resource('admin', 'Backend\AdminController');
		Route::resource('users', 'Backend\UsersController');
		Route::post('users/update-open-flag', [
			'as' => 'users.update_open_flag', 
			'uses' => 'Backend\UsersController@updateOpenFlag'
		]);
		Route::get('feedbacks', [
			'as' => 'feedbacks.index',
			'uses' => 'Backend\FeedbacksController@index'
		]);
	});
});