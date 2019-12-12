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

/*
|--------------------------------------------------------------------------
| SITES AND CELLS ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/update/sitelist', 'SiteController@uploadSitelist')->name('upload-sitelist');
Route::get('/upload_sitelist', 'SiteController@showUploadSitelist');
Route::get('/sites', 'SiteController@showSitelist')->name('sitelist');
Route::get('/site/{site_id}', 'SiteController@showSite')->name('site');
Route::get('/cells', 'SiteController@showCellsList')->name('celllist');
Route::get('/cell/{cell_id}', 'SiteController@showCellDetails')->name('cell');
Route::get('/opt', 'SiteController@showCellOptimizationsList')->name('opt');
Route::get('/site_reports', 'SiteController@showSiteReports')->name('site_reports');

/*
|--------------------------------------------------------------------------
| ALERTS ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/alerts', 'AlertController@showFullAlertslist')->name('alertlist');
Route::get('/alerts/types', 'AlertController@showAlertsByTypes')->name('alerts_types');
Route::get('/alerts/status', 'AlertController@showAlertsByStatus')->name('alerts_status');
Route::get('/alerts/{cell_id}/new_alerts', 'AlertController@showNewAlertslist')->name('cell_new_alerts');
Route::get('/alerts/{cell_id}/pending_alerts', 'AlertController@showPendingAlertslist')->name('cell_pending_alerts');
Route::get('/alerts/{cell_id}/progress_alerts', 'AlertController@showProgressAlertslist')->name('cell_progress_alerts');
Route::get('/alerts/{cell_id}/closed_alerts', 'AlertController@showClosedAlertslist')->name('cell_closed_alerts');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
//USERS
Route::get('/users', 'Auth\RegisterController@showUserlist')->name('userlist');
Route::get('/register_user', 'Auth\RegisterController@showAddUserForm');
Route::get('/{user_id}/profile', 'UpdateUserController@showUserProfile');
Route::post('/{user_id}/profile', 'UpdateUserController@updateUserDetails');

//CONTRACTORS
Route::get('/contractors', 'ContractorController@showContractorsList');
Route::get('/register_contractor', 'ContractorController@showAddContractorForm')->name('add_contractor');

//TEAMS
Route::get('/teams', 'TeamController@showTeamList');
Route::get('/register_team', 'TeamController@showAddTeamForm');

Route::get('/pdf', 'API\TestApp\TestReportController@generatePdf')->name('pdf');