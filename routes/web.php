<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Livewire\Administrators\AdministratorTable;
use App\Livewire\CashTransactions\CashTransactionCurrentWeekTable;
use App\Livewire\CashTransactions\FilterCashTransaction;
use App\Livewire\Dashboard;
use App\Livewire\SchoolClasses\SchoolClassTable;
use App\Livewire\SchoolMajors\SchoolMajorTable;
use App\Livewire\Students\StudentTable;
use App\Livewire\UpdateProfile;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/kelas', SchoolClassTable::class)->name('school-classes.index');
    Route::get('/jurusan', SchoolMajorTable::class)->name('school-majors.index');
    Route::get('/pengguna', AdministratorTable::class)->name('administrators.index');
    Route::get('/profil', UpdateProfile::class)->name('update-profiles.index');
    Route::get('/pelajar', StudentTable::class)->name('students.index');

    Route::get('/kas', CashTransactionCurrentWeekTable::class)->name('cash-transactions.index');
    Route::get('/kas/filter', FilterCashTransaction::class)->name('cash-transactions.filter');
});
