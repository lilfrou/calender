<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Example Routes

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/guest', [App\Http\Controllers\HomeController::class, 'index'])->name('guest');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// User
Route::prefix('user')->middleware(['auth', 'user.approved' ])->group(function () {
Route::get('/{auth}', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::post('/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::post('/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');

});


Auth::routes();




