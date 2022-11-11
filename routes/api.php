<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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
Route::controller(MemberController::class)->name('test.')->prefix('test')->group(function () {
    Route::get('/', [TestController::class, 'test'])->name('index');
    Route::get('/auth', [TestController::class, 'testAuth'])->name('auth')->middleware('auth:api');
    Route::get('/dev', [TestController::class, 'devTest'])->name('dev');
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('patients/{external_id}', [PatientController::class, 'show'])->name('patients.show');
});
