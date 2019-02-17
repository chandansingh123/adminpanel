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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/slider', 'Admin\SliderController@index')->name('slider-index');
Route::get('/slider/create', 'Admin\SliderController@create')->name('slider-create');
Route::post('/slider/store', 'Admin\SliderController@store')->name('slider-store');
Route::get('/slider/{id}/edit', 'Admin\SliderController@edit')->name('slider-edit');
Route::put('/slider/{id}/update', 'Admin\SliderController@update')->name('slider-update');
Route::get('/slider/{id}', 'Admin\SliderController@delete')->name('slider-delete');
