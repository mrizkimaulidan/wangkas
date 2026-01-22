<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/dashboard', 'pages::dashboard');

Route::livewire('/pelajar', 'pages::students.index');

Route::livewire('/jurusan', 'pages::school_majors.index');
Route::livewire('/jurusan/tambah', 'pages::school_majors.create');
Route::livewire('/jurusan/{schoolMajor}/edit', 'pages::school_majors.edit');

Route::livewire('/kelas', 'pages::school_classes.index');
Route::livewire('/kelas/tambah', 'pages::school_classes.create');
Route::livewire('/kelas/{schoolClass}/edit', 'pages::school_classes.edit');

Route::livewire('/users', 'pages::users.index');
