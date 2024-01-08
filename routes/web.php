<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tested', [TestController::class, 'index'])->name('after_login');

Route::get('/auth/google', [GoogleController::class, 'login_with_google'])->name('login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback_from_google'])->name('callback');

Route::get('home', function () {
    return view('home');
})->name('home');
