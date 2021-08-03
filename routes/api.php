<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api','prefix'=>'auth'], function(){

    Route::post('details', 'API\UserController@details');
    Route::post('set_user_points', 'API\UserController@setUserPoint');
    Route::post('join-game','GamesController@joinGame')->name('game.join');
    Route::post('view-adds','GamesController@viewAdds')->name('game.view-adds');

});
