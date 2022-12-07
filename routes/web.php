<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StreetsController;
use App\Http\Controllers\SubCityController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'dashboard.master')->name('parent');

Route::prefix('cms/admin')->group(function () {
    Route::view('/', 'dashboard.master');

    Route::resource('streets', StreetsController::class);
    Route::post('streets_update/{id}', [StreetsController::class, 'update'])->name('streets_update');

    Route::get('/index/streets/{id}', [StreetsController::class, 'indexStreets'])->name('indexStreet');
    Route::get('/create/streets/{id}', [StreetsController::class, 'createStreets'])->name('createStreet');

    Route::resource('bonuses', BonusController::class);
    Route::post('bonuses_update/{id}', [BonusController::class, 'update'])->name('bonuses_update');

    Route::resource('sub_cities', SubCityController::class);
    Route::post('sub_cities_update/{id}', [SubCityController::class, 'update'])->name('sub_cities_update');

    Route::resource('orders', OrderController::class);
    Route::post('orders_update/{id}', [OrderController::class, 'update'])->name('orders_update');

    Route::get('/index/orders/{id}', [OrderController::class, 'indexOrders'])->name('indexOrders');
    Route::get('/create/orders/{id}', [OrderController::class, 'createOrder'])->name('createOrder');

    Route::resource('cities', CityController::class);
    Route::post('cities_update/{id}', [CityController::class, 'update'])->name('cities_update');

    Route::resource('admins', AdminController::class);
    Route::post('admins_update/{id}', [AdminController::class, 'update'])->name('admins_update');

    Route::resource('captains', CaptainController::class);
    Route::post('captains_update/{id}', [CaptainController::class, 'update'])->name('captains_update');

    Route::resource('clients', ClientController::class);
    Route::post('clients_update/{id}', [ClientController::class, 'update'])->name('clients_update');
});