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
    Route::get('/pelajar/history', [StudentHistoryController::class, 'index'])->name('pelajar.index.history');
    Route::post('/pelajar/history/{id}', [StudentHistoryController::class, 'restore'])->name('pelajar.restore.history');
    Route::delete('/pelajar/history/{id}', [StudentHistoryController::class, 'destroy'])->name('pelajar.destroy.history');

    Route::get('/kelas/history', [SchoolClassHistoryController::class, 'index'])->name('kelas.index.history');
    Route::post('/kelas/history/{id}', [SchoolClassHistoryController::class, 'restore'])->name('kelas.restore.history');
    Route::delete('/kelas/history/{id}', [SchoolClassHistoryController::class, 'destroy'])->name('kelas.destroy.history');

    Route::get('/jurusan/history', [SchoolMajorHistoryController::class, 'index'])->name('jurusan.index.history');
    Route::post('/kelas/history/{id}', [SchoolMajorHistoryController::class, 'restore'])->name('jurusan.restore.history');
    Route::delete('/kelas/history/{id}', [SchoolMajorHistoryController::class, 'destroy'])->name('jurusan.destroy.history');
    // End Soft Deletes Routes

    require __DIR__ . '/export.php';
});
