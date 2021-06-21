<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\DashboardChartController;
use App\Http\Controllers\API\v1\StudentController;

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/kelas/{id}', SchoolClassController::class)->name('kelas.show');
    Route::get('/pelajar/{id}', StudentController::class)->name('pelajar.show');
    Route::get('/jurusan/{id}', SchoolMajorController::class)->name('jurusan.show');
    Route::get('/administrator/{id}', AdministratorController::class)->name('administrator.show');
    Route::get('/kas/{id}', CashTransactionController::class)->name('kas.show');

    Route::get('/chart', [DashboardChartController::class, 'getDataSeparateByMonths'])->name('chart');
});
