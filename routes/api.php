<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\InstrumentController;

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

Route::post('/login', [AuthenticateController::class, 'login']);
Route::post('/register',[AuthenticateController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user',[AuthenticateController::class, 'userItself']);
    Route::post('/logout',[AuthenticateController::class, 'logout']);

    Route::post('/instruments/search', [InstrumentController::class, 'search']);
    Route::post('/instruments', [InstrumentController::class, 'store']);
    Route::get('/instruments', [InstrumentController::class, 'index']);
    Route::get('/instruments/{instrument}', [InstrumentController::class, 'show']);
    Route::put('/instruments/{instrument}', [InstrumentController::class, 'update']);
    Route::delete('/instruments/{instrument}', [InstrumentController::class, 'destroy']);
});
