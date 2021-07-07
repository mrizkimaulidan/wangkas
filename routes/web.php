<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolMajorController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\CashTransactionReportController;
use App\Http\Controllers\SchoolClassHistoryController;
use App\Http\Controllers\SchoolMajorHistoryController;
use App\Http\Controllers\StudentHistoryController;

require __DIR__ . '/auth.php';

// If accessing root path "/" it will be redirect to /login
Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pelajar', StudentController::class)->except('create', 'show', 'edit');
    Route::resource('kelas', SchoolClassController::class)->except('create', 'show', 'edit');
    Route::resource('jurusan', SchoolMajorController::class)->except('create', 'show', 'edit');
    Route::resource('administrator', AdministratorController::class)->except('create', 'show', 'edit');
    Route::resource('kas', CashTransactionController::class)->except('create', 'show', 'edit');
    Route::get('/laporan', [CashTransactionReportController::class, 'index'])->name('laporan.index');

    Route::get('/laporan/filter', [CashTransactionReportController::class, 'index'])->name('kas.filter');

    // Soft Deletes Routes
    Route::prefix('/pelajar/histori')->name('pelajar.')->group(function () {
        Route::get('', [StudentHistoryController::class, 'index'])->name('index.history');
        Route::post('{id}', [StudentHistoryController::class, 'restore'])->name('restore.history');
        Route::delete('{id}', [StudentHistoryController::class, 'destroy'])->name('destroy.history');
    });

    Route::prefix('/kelas/histori')->name('kelas.')->group(function () {
        Route::get('', [SchoolClassHistoryController::class, 'index'])->name('index.history');
        Route::post('{id}', [SchoolClassHistoryController::class, 'restore'])->name('restore.history');
        Route::delete('{id}', [SchoolClassHistoryController::class, 'destroy'])->name('destroy.history');
    });

    Route::prefix('/jurusan/histori')->name('jurusan.')->group(function () {
        Route::get('', [SchoolMajorHistoryController::class, 'index'])->name('index.history');
        Route::post('{id}', [SchoolMajorHistoryController::class, 'restore'])->name('restore.history');
        Route::delete('{id}', [SchoolMajorHistoryController::class, 'destroy'])->name('destroy.history');
    });
    // End Soft Deletes Routes

    require __DIR__ . '/export.php';
});
