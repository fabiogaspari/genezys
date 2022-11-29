<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Request;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
        'prefix' => '/address',
        'as' => 'address.',
    ], function() {
        Route::get('/get/{zipCode}', [App\Http\Controllers\ZipCodeController::class, 'get'])->name('get'); 
});
Route::group([
    'prefix' => '/user',
    'as' => 'user.',
], function() {
    Route::get('/list', [App\Http\Controllers\UserController::class, 'list'])->name('list'); 
});