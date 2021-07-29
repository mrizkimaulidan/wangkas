<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\DashboardChartController;
use App\Http\Controllers\API\v1\StudentController;

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/classes/{id}', SchoolClassController::class)->name('classes.show');
    Route::get('/students/{id}', StudentController::class)->name('students.show');
    Route::get('/majors/{id}', SchoolMajorController::class)->name('majors.show');
    Route::get('/administrators/{id}', AdministratorController::class)->name('administrators.show');
    Route::get('/cash-transactions/{id}', CashTransactionController::class)->name('cash-transactions.show');

    Route::get('/chart', DashboardChartController::class)->name('chart');
});
