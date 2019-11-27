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

use App\Http\Controllers\SiteController;
use App\User;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', 'DashboardController@showMainDashboard')->name('dash');
Route::get('/dash', 'DashboardController@showMainDashboard')->name('dash');
Route::get('/sites_dash', 'DashboardController@showSitesDashboard')->name('sites_dash');
Route::get('/alerts_dash', 'DashboardController@showAlertsDashboard')->name('alerts_dash');

/*
|--------------------------------------------------------------------------
| SITES ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/update/sitelist', 'SiteController@uploadSitelist')->name('upload-sitelist');
Route::get('/upload_sitelist', 'SiteController@showUploadSitelist');
Route::get('/sites', 'SiteController@showSitelist')->name('sitelist');
Route::get('/site/{site_id}', 'SiteController@showSite')->name('site');
Route::get('/cells', 'SiteController@showCellsList')->name('celllist');
Route::get('/cell/{cell_id}', 'SiteController@cellDetails')->name('cell');

/*
|--------------------------------------------------------------------------
| ALERTS ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/alerts', 'AlertController@showAlertslist')->name('alertlist');

/*
|--------------------------------------------------------------------------
| USER AND AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/users', 'Auth\RegisterController@showUserlist')->name('userlist');

// REGISTRATIONS
Route::get('/add_admin', 'Auth\RegisterController@showAddAdminForm')->name('add_admin');
Route::get('/add_contractor', 'AuthRegisterController@showAddContractorForm')->name('add_contractor');
Route::get('/add_team', 'Auth\RegisterController@showAddTeamForm')->name('add_team');

Route::get('/pdf', 'API\TestApp\TestReportController@generatePdf')->name('pdf');