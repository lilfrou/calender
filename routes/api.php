<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('test',  [App\Http\Controllers\EventController::class, 'test'])->name('event.test.api');


Route::group(['prefix' => 'event'], function () {
    Route::get('index/{user_id}',  [App\Http\Controllers\EventController::class, 'index'])->name('event.index');
    Route::get('login/{user_id}',  [App\Http\Controllers\EventController::class, 'login'])->name('event.index');
    Route::get('getUsers',  [App\Http\Controllers\EventController::class, 'getUsers'])->name('event.getUsers');
    Route::post('create',  [App\Http\Controllers\EventController::class, 'create'])->name('event.create');
    Route::get('getEvent/{event_id}',  [App\Http\Controllers\EventController::class, 'getEvent'])->name('event.getEvent');
    Route::post('destroy',  [App\Http\Controllers\EventController::class, 'destroy'])->name('event.destroy');
    Route::post('update',  [App\Http\Controllers\EventController::class, 'update'])->name('event.update');
    Route::post('createmeeting',  [App\Http\Controllers\EventController::class, 'create_meeting'])->name('event.create_meeting');



});
