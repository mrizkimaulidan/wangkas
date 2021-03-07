<?php

use App\Http\Controllers\Export\StudentController;
use App\Http\Controllers\Export\CashTransactionController;
use App\Http\Controllers\Export\CashTransactionReportController;

Route::get('/laporan/filter/export/{start_date}/{end_date}', CashTransactionReportController::class)->name('laporan.export');
Route::get('/pelajar/export', StudentController::class)->name('pelajar.export');
Route::get('/kas/export', CashTransactionController::class)->name('kas.export');
