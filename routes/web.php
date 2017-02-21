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

Route::group(['prefix' => 'api/v1'], function () {

	Route::get('lessons/{id}/tags', 'TagController@index');
	Route::resource('lessons', 'LessonController');
	Route::resource('tags', 'TagController', ['only' => ['index', 'show']]);

});
