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

Route::get("reservations", [ReservationController::class, 'index'])->middleware('auth')->name('reservations.index');
Route::get("reservations/create", [ReservationController::class, 'create'])->middleware('auth')->name('reservations.create');
Route::post("reservations/create", [ReservationController::class, "search_propositions"])->name('reservations.search_prop')->middleware('auth');
Route::get("reservations/choose", [ReservationController::class, "show_propositions"])->name('reservations.show_prop')->middleware('auth');
Route::post("reservations", [ReservationController::class, "store"])->name("reservations.store")->middleware('auth');
Route::get("reservations/{id}", [ReservationController::class, "show"])->middleware('auth')->name('reservations.show');
Route::delete("reservations/{id}", [ReservationController::class, "destroy"])->middleware('auth')->name('reservations.destroy');

Route::get("login", [LoginController::class, "loginForm"])->name("login")->middleware('guest');
Route::post("login", [LoginController::class, "authenticate"])->name("authenticate")->middleware('guest');
Route::get("register", [LoginController::class, "registerForm"])->name("register")->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
