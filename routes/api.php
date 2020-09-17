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


Route::group(['prefix' => 'event', 'middleware' => ['api']], function () {
    Route::get('index',  [App\Http\Controllers\EventController::class, 'index'])->name('event.index');
    Route::post('create',  [App\Http\Controllers\EventController::class, 'create'])->name('event.create');

});
