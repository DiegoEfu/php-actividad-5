<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedoraController;
use App\Http\Controllers\ProduccionController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\CompraController;

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

Route::get('/', [LoginController::class, 'show']);

Route::get('/register', function(){
    return view('auth.register');
});
Route::post('/register', [RegisterController::class, 'register'])->name('register_post');

Route::post('/login', [LoginController::class, 'login'])->name('login_post');

Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::resource('productos', ProductoController::class);
Route::resource('proveedoras', ProveedoraController::class);
Route::resource('insumos', InsumoController::class);
Route::resource('compras', CompraController::class);
