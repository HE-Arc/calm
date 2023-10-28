<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\ReservationController;

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

Route::get("/", [HomeController::class, "index"])->name("home");
Route::resource("reservations", ReservationController::class)->middleware('auth');
Route::get("login", [LoginController::class, "loginForm"])->name("login")->middleware('guest');
Route::post("login", [LoginController::class, "authenticate"])->name("authenticate")->middleware('guest');
Route::get("register", [LoginController::class, "registerForm"])->name("register")->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
