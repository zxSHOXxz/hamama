<?php
use App\Http\Controllers\StreetsController;
use App\Http\Controllers\CityController;
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
    Route::view('/' , 'dashboard.master');
    Route::resource('streets' , StreetsController::class);
    Route::post('streets_update/{id}' , [StreetsController::class , 'update'])->name('streets_update');
    Route::resource('cities' , CityController::class);
    Route::post('cities_update/{id}' , [CityController::class , 'update'])->name('cities_update');
    Route::resource('admins' , AdminController::class);
    Route::post('admins_update/{id}' , [AdminController::class , 'update'])->name('admins_update');
});