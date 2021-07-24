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



Auth::routes();

Route::middleware(['admin'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/users', 'API\UserController@index')->name('users');
    Route::get('/users/edit/{id}', 'API\UserController@edit')->name('users.edit');
    Route::get('/users/delete/{id}', 'API\UserController@delete')->name('users.delete');
    Route::post('/users/update/{id}', 'API\UserController@update')->name('users.update');
});
Route::view('/', 'auth.login');

