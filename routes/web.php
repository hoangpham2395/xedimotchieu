<?php

Route::get('/', function () {
    return view('layouts.backend.structure.main');
});

Route::prefix('management')->group(function () {
	Route::resource('admin', 'Backend\AdminController');
});
