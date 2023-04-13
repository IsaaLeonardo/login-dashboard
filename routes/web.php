<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'home'])->name('home')->middleware('guest');
Route::post('/', [UserController::class, 'login'])->name('login');
Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('dashboard')->middleware('auth');
