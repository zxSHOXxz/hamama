<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\CaptainController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EnvelopesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StreetsController;
use App\Http\Controllers\SubCityController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'front')->name('frontView');

Route::get('dashboard', [UserAuthController::class, 'dashboard'])->middleware(['auth', 'verified']);

Route::prefix('cms/admin')->middleware(['auth:admin,client', 'verified'])->group(function () {

    Route::get('/', [UserAuthController::class, 'dashboard'])->name('parent');
    Route::resource('streets', StreetsController::class);
    Route::post('streets_update/{id}', [StreetsController::class, 'update'])->name('streets_update');

    Route::get('/index/streets/{id}', [StreetsController::class, 'indexStreets'])->name('indexStreet');
    Route::get('/create/streets/{id}', [StreetsController::class, 'createStreets'])->name('createStreet');

    Route::resource('bonuses', BonusController::class);
    Route::post('bonuses_update/{id}', [BonusController::class, 'update'])->name('bonuses_update');

    Route::resource('envelopes', EnvelopesController::class);
    Route::post('envelopes_update/{id}', [EnvelopesController::class, 'update'])->name('envelopes_update');

    Route::resource('sub_cities', SubCityController::class);
    Route::post('sub_cities_update/{id}', [SubCityController::class, 'update'])->name('sub_cities_update');

    Route::get('/index/sub_cities/{id}', [SubCityController::class, 'indexSubCities'])->name('indexSubCities');
    Route::get('/create/sub_cities/{id}', [SubCityController::class, 'createSub_city'])->name('createSub_city');

    Route::get('orders/print/{id}', [OrderController::class, 'print'])->name('order_print');
    Route::get('archive', [OrderController::class, 'archive'])->name('orders_archive');
    Route::get('orders_tomorrow', [OrderController::class, 'indexTomorrow'])->name('indexTomorrow');
    Route::get('archive/excel', [OrderController::class, 'exportSearched'])->name('exportSearched');
    Route::post('orders_update/{id}', [OrderController::class, 'update'])->name('orders_update');
    Route::get('/index/orders/{id}', [OrderController::class, 'indexOrders'])->name('indexOrders');
    Route::get('/index/orders_today/{id}', [OrderController::class, 'indexOrdersClientToday'])->name('indexOrdersClientToday');
    Route::get('/create/orders/{id}', [OrderController::class, 'createOrder'])->name('createOrder');
    Route::resource('orders', OrderController::class);

    Route::resource('cities', CityController::class);
    Route::post('cities_update/{id}', [CityController::class, 'update'])->name('cities_update');

    Route::resource('admins', AdminController::class);
    Route::post('admins_update/{id}', [AdminController::class, 'update'])->name('admins_update');

    Route::resource('captains', CaptainController::class);
    Route::post('captains_update/{id}', [CaptainController::class, 'update'])->name('captains_update');

    Route::get('editProfile', [UserAuthController::class, 'editProfile'])->name('editProfile');

    Route::post('update_profile', [UserAuthController::class, 'updateProfile'])->name('update_profile');

    Route::get('editPassword', [UserAuthController::class, 'editPassword'])->name('editPassword');
    Route::post('updatePassword', [UserAuthController::class, 'updatePassword'])->name('updatePassword');

    Route::resource('clients', ClientController::class);

    Route::get('clients_orderes', [ClientController::class, 'indexClientHasOrders'])->name('indexClientHasOrders');

    Route::post('clients_update/{id}', [ClientController::class, 'update'])->name('clients_update');

    Route::resource('roles', RoleController::class);
    Route::post('roles_update/{id}', [RoleController::class, 'update'])->name('roles_update');

    Route::resource('permissions', PermissionController::class);
    Route::post('permissions_update/{id}', [PermissionController::class, 'update'])->name('permissions_update');

    Route::resource('roles.permissions', RolePermissionController::class);

    Route::post('/broadcasting/auth', function () {
        return Auth::user();
    });
});