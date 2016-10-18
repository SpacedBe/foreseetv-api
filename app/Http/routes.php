<?php

// collections
Route::get('/', 'CollectionsController@showAll');
Route::post('collection/create', 'CollectionsController@create');
Route::get('collection/edit/{id}', 'CollectionsController@edit');
Route::post('collection/edit/{id}', 'CollectionsController@editSave');
Route::get('collection/delete/{id}', 'CollectionsController@delete');

// video
Route::post('video/create/{collectionId}', 'VideosController@create')->middleware('auth');
Route::post('video/youtubeAdd/{collectionId}', 'VideosController@youtubeAdd')->middleware('cors');
Route::get('video/delete/{videoId}', 'VideosController@delete')->middleware('auth');
Route::get('video/mass/{collectionId}', 'VideosController@massImport')->middleware('auth');

// AUTH
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');