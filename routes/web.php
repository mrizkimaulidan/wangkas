<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/dashboard', 'pages::dashboard.index')->name('dashboard.index');

Route::livewire('/pelajar', 'pages::students.index')->name('pelajar.index');
Route::livewire('/pelajar/tambah', 'pages::students.create')->name('pelajar.create');
Route::livewire('/pelajar/{student}/edit', 'pages::students.edit')->name('pelajar.edit');

Route::livewire('/jurusan', 'pages::school_majors.index')->name('jurusan.index');
Route::livewire('/jurusan/tambah', 'pages::school_majors.create')->name('jurusan.create');
Route::livewire('/jurusan/{schoolMajor}/edit', 'pages::school_majors.edit')->name('jurusan.edit');

Route::livewire('/kas', 'pages::cash_transactions.index')->name('kas.index');
Route::livewire('/kas/tambah', 'pages::cash_transactions.create')->name('kas.create');

Route::livewire('/kelas', 'pages::school_classes.index')->name('kelas.index');
Route::livewire('/kelas/tambah', 'pages::school_classes.create')->name('kelas.create');
Route::livewire('/kelas/{schoolClass}/edit', 'pages::school_classes.edit')->name('kelas.edit');

Route::livewire('/pengguna', 'pages::users.index')->name('pengguna.index');
Route::livewire('/pengguna/tambah', 'pages::users.create')->name('pengguna.create');
Route::livewire('/pengguna/{user}/edit', 'pages::users.edit')->name('pengguna.edit');

Route::livewire('/profil', 'pages::profiles.edit')->name('profil.edit');
