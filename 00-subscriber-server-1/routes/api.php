<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

Route::post('/technology', function (Request $request) {
    return Log::info('Data from TECHNOLOGY subscription', $request->all());
});
Route::post('/gender-equality', function (Request $request) {
    return Log::info('Data from GENDER EQUALITY subscription', $request->all());
});
Route::post('/agriculture', function (Request $request) {
    return Log::info('Data from AGRICULTURE subscription', $request->all());
});
Route::post('/business', function (Request $request) {
    return Log::info('Data from BUSINESS subscription', $request->all());
});
Route::post('/world-peace', function (Request $request) {
    return Log::info('Data from WORLD PEACE subscription', $request->all());
});
