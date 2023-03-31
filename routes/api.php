<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Account')->name('account.')->group(function(){
    Route::post('/login', 'Login\LoginApiController@login')->name('login');
});

Route::namespace('Appointment')->name('appointment')->middleware('auth:api')->group(function(){
    // Route::get('/appointment/list', 'AppoinmentApiController@list')->name('appointment.list');
    Route::resource('/appointment', AppoinmentApiController::class);
});