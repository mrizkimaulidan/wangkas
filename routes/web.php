<?php

use App\Http\Controllers\LoginController;
use App\Livewire\Administrators\AdministratorTable;
use App\Livewire\Dashboard;
use App\Livewire\SchoolClasses\SchoolClassTable;
use App\Livewire\SchoolMajors\SchoolMajorTable;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/kelas', SchoolClassTable::class)->name('school-classes.index');
Route::get('/jurusan', SchoolMajorTable::class)->name('school-majors.index');
Route::get('/pengguna', AdministratorTable::class)->name('administrators.index');
