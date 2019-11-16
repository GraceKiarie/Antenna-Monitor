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

Route::get('/', function () {
    if (Auth::check()) {
        return view('dashboard.dash');
    } else {
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/dash', function () {
    if (Auth::check()) {
        return view('dashboard.dash');
    } else {
        return view('auth.login');
    }
});

Route::get('/sites_dash', function () {
    if (Auth::check()) {
        return view('dashboard.sites_dash');
    } else {
        return view('auth.login');
    }
});

Route::get('/alerts_dash', function () {
    if (Auth::check()) {
        return view('dashboard.alerts_dash');
    } else {
        return view('auth.login');
    }
});

Route::get('/dash', function () {
    return view('dashboard.dash');
});


/*
|--------------------------------------------------------------------------
| SITES AND CELLS ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/update/sitelist', function () {
    if (Auth::check()) {
        $siteController = new SiteController();
        $siteController->uploadSitelist();
    } else {
        return view('auth.login');
    }
})->name('upload-sitelist');
// Route::post('/update/sitelist', 'SiteController@uploadSitelist')->name('upload-sitelist');

Route::get('/sites', function () {
    if (Auth::check()) {
        // $siteController = new SiteController();
        // $siteController->showSitelist();
        return view('sites.sitelist');
    } else {
        return view('auth.login');
    }
})->name('sitelist');
// Route::get('/sites', 'SiteController@showSitelist')->name('sitelist');

Route::get('/cells', function () {
    if (Auth::check()) {
        $siteController = new SiteController();
        $siteController->showCells();
    } else {
        return view('auth.login');
    }
})->name('cells');
// Route::get('/cells', 'SiteController@showCells')->name('cells');

/*
|--------------------------------------------------------------------------
| USER AND AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::post('/users', function () {
    if (Auth::check()) {
        $siteController = new SiteController();
        $siteController->uploadSitelist();
    } else {
        return view('auth.login');
    }
})->name('upload-sitelist');
// Route::post('/update/sitelist', 'SiteController@uploadSitelist')->name('upload-sitelist');

Route::get('/users', function () {
    if (Auth::check()) {
        $users = User::all();

        return view('auth.userlist', compact("users"));
    } else {
        return view('auth.login');
    }
});

// REGISTRATIONS
 Route::get('/add_admin', function () {
   if (Auth::check()) {
        return view('auth.register_admin');
    } else { return view('auth.login');
    }
});
Route::get('/add_admin', function () {
    return view('auth.register_admin');
});

Route::get('/add_contractor', function () {
    if (Auth::check()) {
        return view('auth.register_contractor');
    } else {
        return view('auth.login');
    }
});

Route::post('/update/sitelist', 'SiteController@uploadSitelist')->name('upload-sitelist');
Route::get('/sites', 'SiteController@showSitelist')->name('sitelist');
Route::get('/cells', 'SiteController@showCells')->name('cells');

Route::get('/pdf', 'API\TestApp\TestReportController@generatePdf')->name('pdf');


Route::get('/add_team', function () {
    if (Auth::check()) {
        return view('auth.register_team');
    } else {
        return view('auth.login');
    }
});

