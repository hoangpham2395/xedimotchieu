<?php
// Frontend
Route::get('/', ['as' => 'home.index', 'uses' => 'Frontend\HomeController@index']);
Route::get('/community', ['as' => 'home.community', 'uses' => 'Frontend\HomeController@community']);
Route::get('login', 'Frontend\Auth\LoginController@getLogin');
Route::post('login', ['as' => 'frontend.login', 'uses' => 'Frontend\Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'frontend.logout', 'uses' => 'Frontend\Auth\LoginController@logout']);
Route::get('register', [
	'as' => 'frontend.register',
	'uses' => 'Frontend\Auth\RegisterController@getRegister'
]);
Route::post('register', [
	'as' => 'frontend.register.store', 
	'uses' => 'Frontend\Auth\RegisterController@postRegister'
]);
Route::get('forgot-password', [
	'as' => 'frontend.forgot_password',
	'uses' => 'Frontend\Auth\ForgotPasswordController@forgotPassword',
]);
Route::post('forgot-password', [
	'as' => 'frontend.post_forgot_password',
	'uses' => 'Frontend\Auth\ForgotPasswordController@postForgotPassword',
]);
Route::post('posts/get-districts', [
	'as' => 'frontend.districts.get_districts_by_city', 
	'uses' => 'Frontend\DistrictsController@getDistrictsByCity'
]);
Route::get('community/{id}', [
	'as' => 'home.community.detail',
	'uses' => 'Frontend\HomeController@detail'
]);
Route::get('feedbacks', [
	'as' => 'frontend.feedbacks.create',
	'uses' => 'Frontend\FeedBacksController@create',
]);
Route::post('feedbacks', [
	'as' => 'frontend.feedbacks.store',
	'uses' => 'Frontend\FeedBacksController@store',
]);
Route::middleware(['isLoginFrontend'])->group(function() {
	Route::prefix(getFrontendAlias())->group(function() {
		Route::resource('users', 'Frontend\UsersController')->only('edit', 'update')->names('frontend.users');
		Route::resource('posts', 'Frontend\PostsController')->names('frontend.posts');
		Route::resource('cars', 'Frontend\CarsController')->names('frontend.cars');
		Route::resource('rates', 'Frontend\RatesController')->names('frontend.rates')->only('store');
	});
});

// Socialite
Route::get('login/redirect/{social}', 'Frontend\Auth\LoginController@redirect');
Route::get('login/callback/{social}', 'Frontend\Auth\LoginController@callback');

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