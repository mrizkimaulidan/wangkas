<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Export\AdministratorController;
use App\Http\Controllers\Export\StudentController;
use App\Http\Controllers\Export\CashTransactionController;
use App\Http\Controllers\Export\CashTransactionReportController;

Route::get('/report/filter/export/{start_date}/{end_date}', CashTransactionReportController::class)->name('report.export');
Route::get('/students/export', StudentController::class)->name('students.export');
Route::get('/cash-transactions/export', CashTransactionController::class)->name('cash-transactions.export');
Route::get('/administrators/export', AdministratorController::class)->name('administrators.export');
