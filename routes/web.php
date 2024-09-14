<?php

use App\Livewire\Dashboard;
use App\Livewire\SchoolClasses\SchoolClassTable;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class);
Route::get('/kelas', SchoolClassTable::class);
