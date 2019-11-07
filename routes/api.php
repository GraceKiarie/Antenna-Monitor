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

Route::post('register', 'API\Auth\UserController@register');
Route::post('login', 'API\Auth\UserController@loginMobile');
Route::post('signin', 'API\Auth\UserController@loginWeb');




Route::group(['middleware' => 'auth:api'], function(){

    Route::post('teams/add', 'TestController@createTeams');
    Route::get('teams', 'TestController@allTeams');
    Route::post('contractors/add', 'TestController@createContractors');
    Route::patch('password/reset', 'API\Auth\UserController@updatePassword');
});

