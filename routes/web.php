<?php

use App\Livewire\Administrators\AdministratorTable;
use App\Livewire\Authentication\Login;
use App\Livewire\Authentication\Logout;
use App\Livewire\CashTransactions\CashTransactionCurrentWeekTable;
use App\Livewire\CashTransactions\FilterCashTransaction;
use App\Livewire\Dashboard;
use App\Livewire\SchoolClasses\SchoolClassTable;
use App\Livewire\SchoolMajors\SchoolMajorTable;
use App\Livewire\Students\StudentTable;
use App\Livewire\UpdateProfile;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::livewire('/', Login::class);

    Route::livewire('/login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::livewire('/logout', Logout::class)->name('logout');

    Route::livewire('/dashboard', Dashboard::class)->name('dashboard');
    Route::livewire('/kelas', SchoolClassTable::class)->name('school-classes.index');
    Route::livewire('/jurusan', SchoolMajorTable::class)->name('school-majors.index');
    Route::livewire('/pengguna', AdministratorTable::class)->name('administrators.index');
    Route::livewire('/profil', UpdateProfile::class)->name('update-profiles.index');
    Route::livewire('/pelajar', StudentTable::class)->name('students.index');

    Route::livewire('/kas', CashTransactionCurrentWeekTable::class)->name('cash-transactions.index');
    Route::livewire('/kas/filter', FilterCashTransaction::class)->name('cash-transactions.filter');
});
