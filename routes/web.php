<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

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

Route::get('/register', function(){
    return view('auth.register');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register_post');

Route::get('/login', [LoginController::class, 'show']);

Route::post('/login', [LoginController::class, 'login'])->name('login_post');

Route::get('/home', [HomeController::class, 'index']);
