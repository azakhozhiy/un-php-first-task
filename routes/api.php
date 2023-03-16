<?php

use App\Http\Controllers\DepartmentController;
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

Route::prefix('/departments')->group(function (): void {
    Route::prefix('/{department}')->group(function (): void {
        Route::get('/active-employees', [DepartmentController::class, 'getActiveEmployees']);
        Route::post('/block-employees', [DepartmentController::class, 'blockEmployees']);
    });
});
