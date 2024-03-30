<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExchangeController as AdminExchangeController;
use App\Http\Controllers\User\AttendanceController;
use App\Http\Controllers\User\ExchangeController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->middleware('track.visitor')->name('user.home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'rolecheck:admin']], function () {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::put('/', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/search/{query}', [UserController::class, 'search'])->name('search');
        Route::post('/add-point', [UserController::class, 'addPoint'])->name('addPoint');
    });

    Route::group(['prefix' => 'exchange', 'as' => 'exchange.'], function () {
        Route::get('/', [AdminExchangeController::class, 'index'])->name('index');
        Route::get('/search/{query}', [AdminExchangeController::class, 'search'])->name('search');
        Route::delete('/{id}', [AdminExchangeController::class, 'destroy'])->name('destroy');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'rolecheck:user']], function () {
    Route::get('/profile-user', [ProfileController::class, 'index'])->name('profile');
    Route::get('/penukaran-point', [ExchangeController::class, 'index'])->name('penukaran-point.index');
    Route::post('/penukaran-point', [ExchangeController::class, 'store'])->name('penukaran-point.store');
    Route::get('/penukaran-point/riwayat', [ExchangeController::class, 'history'])->name('penukaran-point.history');
    Route::resource('/attendance', AttendanceController::class);
});
