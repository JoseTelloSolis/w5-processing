<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\HomeController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::controller(AuthController::class)->group(function() {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/getprofile', [AuthController::class, 'getProfile']);
    Route::post('/updateprofile', [AuthController::class, 'updateProfile']);
});

Route::get('/getconfig', [ConfigurationController::class, 'getConfig']);
Route::post('/updateconfig', [ConfigurationController::class, 'updateConfig']);

Route::get('/gethome', [HomeController::class, 'getHome']);
Route::post('/updatehome', [HomeController::class, 'updateHome']);

Route::get('/getwebconfig', [ConfigurationController::class, 'getWebConfig']);
Route::get('/getwebhome', [HomeController::class, 'getWebHome']);