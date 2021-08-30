<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\ManualEvent;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\RfidController;
use App\Http\Controllers\DevicesController;
use App\Models\Contract;
use App\Models\Device;

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
        Route::get('get-devices', 'DashboardController@getDevices')->name('getDevices');
        Route::get('get-device', 'DashboardController@getDevice')->name('getDevice');
    });

    Route::prefix('truck-monitoring')->name('truck-monitoring.')->group(function () {
       Route::get('/','TruckMonitoringController@index')->name('index');
    });

    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/','DevicesController@index')->name('index');
     });

    Route::view('contact', 'pages.contact')->name('contact');

    Route::view('test', 'pages.test');

    Route::get('send', function () {
        broadcast(new ManualEvent(auth()->user()));
        return response('Send');
    });

    Route::prefix('devices')->name('devices.')->group(function () {
        Route::get('/', [DevicesController::class,'index'])->name('index');
        Route::get('/create', [DevicesController::class,'create'])->name('create');
        Route::post('/store', [DevicesController::class,'store'])->name('store');
        Route::get('/edit/{id}', [DevicesController::class,'edit'])->name('edit');
        Route::patch('/update/{id}', [DevicesController::class,'update'])->name('update');
        Route::delete('/destroy/{id}', [DevicesController::class,'destroy'])->name('destroy');
        // Route::resource('user', UserController::class);
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('index');
        Route::get('/create', [UserController::class,'create'])->name('create');
        Route::post('/store', [UserController::class,'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class,'edit'])->name('edit');
        Route::patch('/update/{id}', [UserController::class,'update'])->name('update');
        Route::delete('/destroy/{id}', [UserController::class,'destroy'])->name('destroy');
        // Route::resource('user', UserController::class);
    });

    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/', [CompanyController::class,'index'])->name('index');
        Route::get('/create', [CompanyController::class,'create'])->name('create');
        Route::post('/store', [CompanyController::class,'store'])->name('store');
        Route::get('/edit/{id}', [CompanyController::class,'edit'])->name('edit');
        Route::patch('/update/{id}', [CompanyController::class,'update'])->name('update');
        Route::delete('/destroy/{id}', [CompanyController::class,'destroy'])->name('destroy');
    });

    Route::prefix('contract')->name('contract.')->group(function () {
        Route::get('/', [ContractsController::class,'index'])->name('index');
        Route::get('/create', [ContractsController::class,'create'])->name('create');
        Route::post('/store', [ContractsController::class,'store'])->name('store');
        Route::get('/edit/{id}', [ContractsController::class,'edit'])->name('edit');
        Route::patch('/update/{id}', [ContractsController::class,'update'])->name('update');
        Route::delete('/destroy/{id}', [ContractsController::class,'destroy'])->name('destroy');
    });

    Route::prefix('rfid')->name('rfid.')->group(function () {
        Route::get('/', [RfidController::class,'index'])->name('index');
        Route::get('/create', [RfidController::class,'create'])->name('create');
        Route::post('/store', [RfidController::class,'store'])->name('store');
        Route::get('/edit/{id}', [RfidController::class,'edit'])->name('edit');
        Route::patch('/update/{id}', [RfidController::class,'update'])->name('update');
        Route::delete('/destroy/{id}', [RfidController::class,'destroy'])->name('destroy');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
