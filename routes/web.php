<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ExchangeController as AdminExchangeController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\EventSubmissionController;
use App\Http\Controllers\User\AttendanceController;
use App\Http\Controllers\User\ExchangeController;
use App\Http\Controllers\User\EventController;
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

// Deploy: run migration via browser (shared hosting). Hapus route ini setelah selesai!
// Contoh: yourdomain.com/deploy-migrate?key=rahasia_dari_env
Route::get('/deploy-migrate', function () {
    if (request('key') !== env('DEPLOY_MIGRATE_KEY', 'ganti_di_env')) {
        abort(404);
    }
    Artisan::call('migrate', ['--force' => true]);
    return '<pre>' . Artisan::output() . '</pre>';
});

// To create symlink for storage
Route::get('/create-symlink', function () {
    Artisan::call('storage:link');
    return '<pre>' . Artisan::output() . '</pre>';
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'rolecheck:admin']], function () {
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
        Route::put('/transaction/{transaction}/status', [AdminExchangeController::class, 'updateStatus'])->name('transaction.status');
        Route::delete('/{id}', [AdminExchangeController::class, 'destroy'])->name('destroy');
    });

    Route::resource('events', AdminEventController::class)->except(['show']);
    Route::get('/event-submissions', [EventSubmissionController::class, 'index'])->name('event-submissions.index');
    Route::post('/event-submissions/{submission}/approve', [EventSubmissionController::class, 'approve'])->name('event-submissions.approve');
    Route::post('/event-submissions/{submission}/reject', [EventSubmissionController::class, 'reject'])->name('event-submissions.reject');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'verified', 'rolecheck:user']], function () {
    Route::get('/profile-user', [ProfileController::class, 'index'])->name('profile');
    Route::get('/penukaran-point', [ExchangeController::class, 'index'])->name('penukaran-point.index');
    Route::post('/penukaran-point', [ExchangeController::class, 'store'])->name('penukaran-point.store');
    Route::get('/penukaran-point/riwayat', [ExchangeController::class, 'history'])->name('penukaran-point.history');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events/submit', [EventController::class, 'storeSubmission'])->name('events.submit');
    Route::get('/events/riwayat', [EventController::class, 'submissionHistory'])->name('events.history');
    Route::resource('/attendance', AttendanceController::class);
});
