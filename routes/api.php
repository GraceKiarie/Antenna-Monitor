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

    Route::post('installation/certificate/{id}', 'API\InstallationApp\InstallationReportController@sendMail');
    Route::post('upload', 'API\InstallationApp\InstallationController@uploadImage');

    Route::post('roles/add', 'TestController@createRoles');
    Route::post('teams/add', 'TestController@createTeams');
    Route::get('teams', 'TestController@allTeams');
    Route::post('contractors/add', 'TestController@createContractors');

    Route::group(['middleware' => 'auth:api'], function () {

        Route::patch('password/reset', 'API\Auth\UserController@updatePassword');

        //testapp routes
        Route::post('qr', 'API\TestApp\TestController@qrTest');
        Route::post('imsi', 'API\TestApp\TestController@ImsiTest');
        Route::post('/sendmail/{id}', 'API\TestApp\TestReportController@sendMail')->name('mail');

        //application app routes
        Route::post('nearby/sites', 'API\InstallationApp\InstallationController@getNearbySites');
        Route::get('sitelist', 'API\InstallationApp\InstallationController@showSitelist');
        Route::post('technologies', 'API\InstallationApp\InstallationController@listSiteTechnologies');
        Route::post('sectors', 'API\InstallationApp\InstallationController@listSectors');
        Route::post('validate', 'API\InstallationApp\InstallationController@validateCellID');



    });

});

