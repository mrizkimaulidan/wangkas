<?php

use App\Livewire\Dashboard;
use App\Livewire\SchoolClasses\SchoolClassTable;
use App\Livewire\SchoolMajors\SchoolMajorTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/kelas', SchoolClassTable::class)->name('school-classes.index');
Route::get('/jurusan', SchoolMajorTable::class)->name('school-majors.index');
