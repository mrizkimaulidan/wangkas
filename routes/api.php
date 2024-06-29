<?php

use App\Http\Controllers\API\v1\CashTransactionStatisticController;
use App\Http\Controllers\API\v1\AdministratorController;
use App\Http\Controllers\API\v1\CashTransactionController;
use App\Http\Controllers\API\v1\SchoolClassController;
use App\Http\Controllers\API\v1\SchoolMajorController;
use App\Http\Controllers\API\v1\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/')->name('api.v1.')->group(function () {
    Route::get('/cash-transactions/statistics', CashTransactionStatisticController::class)
        ->name('cash-transactions.statistics');

    Route::apiResources([
        '/school-classes' => SchoolClassController::class,
        '/school-majors' => SchoolMajorController::class,
        '/administrators' => AdministratorController::class,
        '/students' => StudentController::class,
        '/cash-transactions' => CashTransactionController::class,
    ]);
});
