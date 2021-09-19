<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\DashboardChartController;
use App\Http\Controllers\API\v1\StudentController;

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/school-class/{id}', [SchoolClassController::class, 'show'])->name('school-class.show');
    Route::get('/school-class/{id}/edit', [SchoolClassController::class, 'edit'])->name('school-class.edit');

    Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');

    Route::get('/school-major/{id}', [SchoolMajorController::class, 'show'])->name('school-major.show');
    Route::get('/school-major/{id}/edit', [SchoolMajorController::class, 'edit'])->name('school-major.edit');

    Route::get('/administrator/{id}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/administrator/{id}/edit', [AdministratorController::class, 'edit'])->name('administrator.edit');

    Route::get('/cash-transaction/{id}', [CashTransactionController::class, 'show'])->name('cash-transaction.show');
    Route::get('/cash-transaction/{id}/edit', [CashTransactionController::class, 'edit'])->name('cash-transaction.edit');

    Route::get('/chart', DashboardChartController::class)->name('chart');
});
