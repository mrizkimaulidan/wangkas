<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\CashTransactionExportController;
use App\Http\Controllers\CashTransactionFilterController;
use App\Http\Controllers\CashTransactionReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileSettingController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolMajorController;
use App\Http\Controllers\StudentController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('dashboard'));

    Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/school-classes', [SchoolClassController::class, 'index'])->name('school-classes.index');
    Route::get('/school-classes/export', [SchoolClassController::class, 'export'])->name('school-classes.export');

    Route::get('/school-majors', [SchoolMajorController::class, 'index'])->name('school-majors.index');
    Route::get('/school-majors/export', [SchoolMajorController::class, 'export'])->name('school-majors.export');

    Route::get('/administrators', [AdministratorController::class, 'index'])->name('administrators.index');
    Route::get('/administrators/export', [AdministratorController::class, 'export'])->name('administrators.export');

    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/export', [StudentController::class, 'export'])->name('students.export');

    Route::get('/cash-transactions', [CashTransactionController::class, 'index'])->name('cash-transactions.index');
    Route::get('/cash-transactions/export', CashTransactionExportController::class)->name('cash-transactions.export');
    Route::get('/cash-transactions/filter', CashTransactionFilterController::class)->name('cash-transactions.filter.index');

    Route::get('/settings', [ProfileSettingController::class, 'index'])->name('profile-settings.index');
    Route::put('/settings', [ProfileSettingController::class, 'update'])->name('profile-settings.update');
});
