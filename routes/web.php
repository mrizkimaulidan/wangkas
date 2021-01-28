<?php

use App\Http\Controllers\API\v1\SchoolClassController as V1SchoolClassController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::name('admin.')->group(function () {
    Route::resource('siswa', StudentController::class);
    Route::resource('kelas', SchoolClassController::class);
    Route::resource('jurusan', SchoolMajorController::class);
});

require __DIR__ . '/auth.php';
