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
Route::group(['prefix' => 'v1'], function () {
Route::post('register', 'API\Auth\UserController@register');
Route::post('login', 'API\Auth\UserController@login');
Route::post('login/authentication/{id}', 'API\Auth\UserController@generateToken');
Route::post('signin', 'API\Auth\UserController@loginWeb');



Route::post('roles/add', 'TestController@createRoles');

Route::group([ 'middleware' => 'auth:api'], function () {


    Route::post('teams/add', 'TestController@createTeams');
    Route::get('teams', 'TestController@allTeams');
    Route::post('contractors/add', 'TestController@createContractors');
    Route::patch('password/reset', 'API\Auth\UserController@updatePassword');


    //testapp routes
    Route::post('qr', 'API\TestApp\TestController@qrTest');
    Route::post('imsi', 'API\TestApp\TestController@ImsiTest');
});
});

