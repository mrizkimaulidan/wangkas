<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\API\v1\SchoolClassController as V1SchoolClassController;
use App\Http\Controllers\CashTransactionController;
use App\Http\Controllers\DashboardController;
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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::name('admin.')->group(function () {
    Route::resource('siswa', StudentController::class)->except('create', 'show', 'edit');
    Route::resource('kelas', SchoolClassController::class)->except('create', 'show', 'edit');
    Route::resource('jurusan', SchoolMajorController::class)->except('create', 'show', 'edit');
    Route::resource('administrator', AdministratorController::class)->except('create', 'show', 'edit');
    Route::resource('kas', CashTransactionController::class)->except('create', 'show', 'edit');
});

require __DIR__ . '/auth.php';
