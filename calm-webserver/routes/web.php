<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\LoginController;
use \App\Http\Controllers\ReservationController;
use \App\Http\Controllers\UserController;

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
Route::post("register", [LoginController::class, "register"])->middleware('guest')->name('register');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ORGANIZATIONS MANAGEMENT
Route::get("management/organizations", [\App\Http\Controllers\Management\OrganizationController::class, 'index'])->middleware('auth')->can('admin')->name('management.organizations.index');
Route::get("management/organizations/create", [\App\Http\Controllers\Management\OrganizationController::class, 'create'])->middleware('auth')->can('admin')->name('management.organizations.create');
Route::post("management/organizations", [\App\Http\Controllers\Management\OrganizationController::class, 'store'])->middleware('auth')->can('admin')->name('management.organizations.store');
Route::get("management/organizations/{id}", [\App\Http\Controllers\Management\OrganizationController::class, 'show'])->middleware('auth')->can('admin')->name('management.organizations.show');
Route::get("management/organizations/{id}/edit", [\App\Http\Controllers\Management\OrganizationController::class, 'edit'])->middleware('auth')->can('admin')->name('management.organizations.edit');
Route::put("management/organizations/{id}", [\App\Http\Controllers\Management\OrganizationController::class, 'update'])->middleware('auth')->can('admin')->name('management.organizations.update');
Route::delete("management/organizations/{id}", [\App\Http\Controllers\Management\OrganizationController::class, 'destroy'])->middleware('auth')->can('admin')->name('management.organizations.destroy');

// USERS MANAGEMENT
Route::get("management/users", [\App\Http\Controllers\Management\UserController::class, 'index'])->middleware('auth')->can('admin')->name('management.users.index');
Route::get("management/users/create", [\App\Http\Controllers\Management\UserController::class, 'create'])->middleware('auth')->can('admin')->name('management.users.create');
Route::post("management/users", [\App\Http\Controllers\Management\UserController::class, 'store'])->middleware('auth')->can('admin')->name('management.users.store');
Route::get("management/users/{id}", [\App\Http\Controllers\Management\UserController::class, 'show'])->middleware('auth')->can('admin')->name('management.users.show');
Route::get("management/users/{id}/edit", [\App\Http\Controllers\Management\UserController::class, 'edit'])->middleware('auth')->can('admin')->name('management.users.edit');
Route::put("management/users/{id}", [\App\Http\Controllers\Management\UserController::class, 'update'])->middleware('auth')->can('admin')->name('management.users.update');
Route::delete("management/users/{id}", [\App\Http\Controllers\Management\UserController::class, 'destroy'])->middleware('auth')->can('admin')->name('management.users.destroy');

// LAUNDRIES MANAGEMENT
Route::get("management/{orgId}/laundries", [\App\Http\Controllers\Management\LaundryController::class, 'index'])->middleware('auth')->can('admin')->name('management.laundries.index');
Route::get("management/{orgId}/laundries/create", [\App\Http\Controllers\Management\LaundryController::class, 'create'])->middleware('auth')->can('admin')->name('management.laundries.create');
Route::post("management/{orgId}/laundries", [\App\Http\Controllers\Management\LaundryController::class, 'store'])->middleware('auth')->can('admin')->name('management.laundries.store');
Route::get("management/{orgId}/laundries/{id}", [\App\Http\Controllers\Management\LaundryController::class, 'show'])->middleware('auth')->can('admin')->name('management.laundries.show');
Route::get("management/{orgId}/laundries/{id}/edit", [\App\Http\Controllers\Management\LaundryController::class, 'edit'])->middleware('auth')->can('admin')->name('management.laundries.edit');
Route::put("management/{orgId}/laundries/{id}", [\App\Http\Controllers\Management\LaundryController::class, 'update'])->middleware('auth')->can('admin')->name('management.laundries.update');
Route::delete("management/{orgId}/laundries/{id}", [\App\Http\Controllers\Management\LaundryController::class, 'destroy'])->middleware('auth')->can('admin')->name('management.laundries.destroy');

// USER
Route::get("user", [UserController::class, 'index'])->middleware('auth')->name('user.index');


