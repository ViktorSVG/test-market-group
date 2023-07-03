<?php

use Illuminate\Support\Facades\Route;

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


\Auth::routes([
    'register' => false, // Registration Routes...
    'reset'    => false, // Password Reset Routes...
    'verify'   => false, // Email Verification Routes...
]);

Route::any('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => ['auth','permissions'],
    'prefix' => ''
], function() {
    Route::get('{year?}', [App\Http\Controllers\HomeController::class, 'index'])->name('app.index')->where('year', '|\d{4}');
    Route::post('vacation/save', [App\Http\Controllers\HomeController::class, 'save'])->name('app.vacation.save');
    Route::post('vacation/approve', [App\Http\Controllers\HomeController::class, 'approve'])->name('app.vacation.approve');
    Route::post('vacation/drop', [App\Http\Controllers\HomeController::class, 'drop'])->name('app.vacation.drop');
});
