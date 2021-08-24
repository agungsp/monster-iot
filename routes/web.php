<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });

    Route::prefix('truck-monitoring')->name('truck-monitoring.')->group(function () {
       Route::get('/','TruckMonitoringController@index')->name('index');
    });

    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/','DevicesController@index')->name('index');
     });

    Route::view('contact', 'pages.contact')->name('contact');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
