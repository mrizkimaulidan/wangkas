<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolMajorController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\CashTransactionFilterController;
use App\Http\Controllers\CashTransactionHistoryController;
use App\Http\Controllers\CashTransactionReportController;
use App\Http\Controllers\SchoolClassHistoryController;
use App\Http\Controllers\SchoolMajorHistoryController;
use App\Http\Controllers\StudentHistoryController;

require __DIR__ . '/auth.php';

// If accessing root path "/" it will be redirect to /login
Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('students', StudentController::class)->except('create', 'show', 'edit');
    Route::resource('school-classes', SchoolClassController::class)->except('create', 'show', 'edit');
    Route::resource('school-majors', SchoolMajorController::class)->except('create', 'show', 'edit');
    Route::resource('administrators', AdministratorController::class)->except('create', 'show', 'edit', 'destroy');

    Route::get('/cash-transactions/filter', CashTransactionFilterController::class)->name('cash-transactions.filter');
    Route::resource('cash-transactions', CashTransactionController::class)->except('create', 'show', 'edit');

    //  Report routes
    Route::get('/report', CashTransactionReportController::class)->name('report.index');
    // End of report routes

    // Soft Deletes Routes
    Route::controller(StudentHistoryController::class)->prefix('/students/history')->name('students.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(CashTransactionHistoryController::class)->prefix('/cash-transactions/history')->name('cash-transactions.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(SchoolClassHistoryController::class)->prefix('/school-classes/history')->name('school-classes.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });

    Route::controller(SchoolMajorHistoryController::class)->prefix('/school-majors/history')->name('school-majors.')->group(function () {
        Route::get('', 'index')->name('index.history');
        Route::post('{id}', 'restore')->name('restore.history');
        Route::delete('{id}', 'destroy')->name('destroy.history');
    });
    // End Soft Deletes Routes

    require __DIR__ . '/export.php';
});
