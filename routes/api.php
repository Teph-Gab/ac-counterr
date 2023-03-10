<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SheetController;
use App\Http\Controllers\Api\CounterController;
use App\Http\Controllers\Api\OldCounterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('counter', CounterController::class);
Route::get('buttonshow', [CounterController::class, 'showButton']);

Route::apiResource('oldcounter', OldCounterController::class);

Route::apiResource('sheets', SheetController::class);

Route::get('weeklydata', [OldCounterController::class, 'getWeeklyData']);

Route::get('monthlydata', [OldCounterController::class, 'getMonthlyData']);

Route::get('getuser', [UserController::class, 'getUser']);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::apiResource('user', UserController::class);
    Route::get('getroles', [UserController::class, 'getRoles']);
    Route::post('getuseradmin/{id}', [UserController::class, 'getUserAdmin']);
    Route::post('getchartuseradmin/{id}', [UserController::class, 'getChartUserAdmin']);
  });

