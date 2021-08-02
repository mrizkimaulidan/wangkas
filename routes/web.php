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

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Resource routes
    Route::resource('students', StudentController::class)->except('create', 'show', 'edit');
    Route::resource('classes', SchoolClassController::class)->except('create', 'show', 'edit');
    Route::resource('majors', SchoolMajorController::class)->except('create', 'show', 'edit');
    Route::resource('administrators', AdministratorController::class)->except('create', 'show', 'edit', 'destroy');
    Route::resource('cash-transactions', CashTransactionController::class)->except('create', 'show', 'edit');
    // End of resource routes

    //  Report routes
    Route::get('/report', CashTransactionReportController::class)->name('report.index');
    Route::get('/report/filter', CashTransactionReportController::class)->name('report.filter');
    // End of report routes

    // Soft Deletes Routes
    Route::prefix('/students/history')->name('students.')->group(function () {
        Route::get('', [StudentHistoryController::class, 'index'])->name('index.history');
        Route::post('{id}', [StudentHistoryController::class, 'restore'])->name('restore.history');
        Route::delete('{id}', [StudentHistoryController::class, 'destroy'])->name('destroy.history');
    });

    Route::prefix('/classes/history')->name('classes.')->group(function () {
        Route::get('', [SchoolClassHistoryController::class, 'index'])->name('index.history');
        Route::post('{id}', [SchoolClassHistoryController::class, 'restore'])->name('restore.history');
        Route::delete('{id}', [SchoolClassHistoryController::class, 'destroy'])->name('destroy.history');
    });

    Route::prefix('/majors/history')->name('majors.')->group(function () {
        Route::get('', [SchoolMajorHistoryController::class, 'index'])->name('index.history');
        Route::post('{id}', [SchoolMajorHistoryController::class, 'restore'])->name('restore.history');
        Route::delete('{id}', [SchoolMajorHistoryController::class, 'destroy'])->name('destroy.history');
    });
    // End Soft Deletes Routes

    require __DIR__ . '/export.php';
});
