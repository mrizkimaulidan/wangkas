<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\StudentController;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\DashboardChartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')->prefix('v1')->group(function () {
    Route::get('/kelas/{kela}', [SchoolClassController::class, 'show'])->name('kelas.show');
    Route::get('/pelajar/{pelajar}', [StudentController::class, 'show'])->name('pelajar.show');
    Route::get('/jurusan/{jurusan}', [SchoolMajorController::class, 'show'])->name('jurusan.show');
    Route::get('/administrator/{administrator}', [AdministratorController::class, 'show'])->name('administrator.show');
    Route::get('/kas/{id}', [CashTransactionController::class, 'show'])->name('kas.show');

    Route::get('/chart', [DashboardChartController::class, 'getDataSeparateByMonths'])->name('chart');
});
