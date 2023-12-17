<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Management\InvitationController;
use App\Http\Controllers\Management\OrganizationController;
use App\Http\Controllers\Management\UserManagementController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get("management/organizations", [OrganizationController::class, 'index'])->middleware('auth')->can('admin')->name('management.organizations.index');
Route::get("management/organizations/create", [OrganizationController::class, 'create'])->middleware('auth')->can('admin')->name('management.organizations.create');
Route::post("management/organizations", [OrganizationController::class, 'store'])->middleware('auth')->can('admin')->name('management.organizations.store');
Route::get("management/organizations/{id}", [OrganizationController::class, 'show'])->middleware('auth')->can('admin')->name('management.organizations.show');
Route::get("management/organizations/{id}/edit", [OrganizationController::class, 'edit'])->middleware('auth')->can('admin')->name('management.organizations.edit');
Route::put("management/organizations/{id}", [OrganizationController::class, 'update'])->middleware('auth')->can('admin')->name('management.organizations.update');
Route::delete("management/organizations/{id}", [OrganizationController::class, 'destroy'])->middleware('auth')->can('admin')->name('management.organizations.destroy');

// USERS MANAGEMENT
Route::get("management/{org}/users", [UserManagementController::class, 'index'])->middleware('auth')->can('admin')->name('management.users.index');
Route::delete('management/{org}/users/{id}', [UserManagementController::class, 'expel'])->middleware('auth')->can('admin')->name('management.users.expel');
Route::post("management/{org}/users", [UserManagementController::class, 'store'])->middleware('auth')->can('admin')->name('management.users.store');
Route::get("management/{org}/users/add", [UserManagementController::class, 'add'])->middleware('auth')->can('admin')->name('management.users.add');
Route::get('management/{org}/users/{id}', [UserManagementController::class, 'userDetails'])->middleware('auth')->can('admin')->name('management.users.userDetails');
Route::delete("management/reservations/{id}", [UserManagementController::class, 'deleteReservation'])->middleware('auth')->can('admin')->name('management.users.reservation.delete');

// INVITATION MANAGEMENT
Route::get("management/{org}/invite", [InvitationController::class, 'index'])->middleware('auth')->can('admin')->name('invitation.index');
Route::put("management/invite/{id}/enable", [InvitationController::class, 'enable'])->middleware('auth')->can('admin')->name('invitation.enable');
Route::put("management/invite/{id}/disable", [InvitationController::class, 'disable'])->middleware('auth')->can('admin')->name('invitation.disable');
Route::post("management/{org}/invite", [InvitationController::class, 'create'])->middleware('auth')->can('admin')->name('invitation.create');
Route::get("organisation/join", [InvitationController::class, 'joinView'])->middleware('auth')->name('invitation.joinView');
Route::post("organisation/join", [InvitationController::class, 'processJoin'])->middleware('auth')->name('invitation.join');

// LAUNDRIES MANAGEMENT
Route::get("management/{orgId}/laundries", [\App\Http\Controllers\Management\LaundryController::class, 'index'])->middleware('auth')->can('admin')->name('management.laundries.index');
Route::get("management/{orgId}/laundries/create", [\App\Http\Controllers\Management\LaundryController::class, 'create'])->middleware('auth')->can('admin')->name('management.laundries.create');
Route::post("management/{orgId}/laundries", [\App\Http\Controllers\Management\LaundryController::class, 'store'])->middleware('auth')->can('admin')->name('management.laundries.store');
Route::get("management/{orgId}/laundries/{id}", [\App\Http\Controllers\Management\LaundryController::class, 'show'])->middleware('auth')->can('admin')->name('management.laundries.show');
Route::get("management/{orgId}/laundries/{id}/edit", [\App\Http\Controllers\Management\LaundryController::class, 'edit'])->middleware('auth')->can('admin')->name('management.laundries.edit');
Route::put("management/{orgId}/laundries/{id}", [\App\Http\Controllers\Management\LaundryController::class, 'update'])->middleware('auth')->can('admin')->name('management.laundries.update');
Route::delete("management/{orgId}/laundries/{id}", [\App\Http\Controllers\Management\LaundryController::class, 'destroy'])->middleware('auth')->can('admin')->name('management.laundries.destroy');


// MACHINES MANAGEMENT
Route::get("management/{orgId}/laundries/{laundryId}/machines", [\App\Http\Controllers\Management\MachineController::class, 'index'])->middleware('auth')->can('admin')->name('management.machines.index');
Route::get("management/{orgId}/laundries/{laundryId}/machines/create", [\App\Http\Controllers\Management\MachineController::class, 'create'])->middleware('auth')->can('admin')->name('management.machines.create');
Route::post("management/{orgId}/laundries/{laundryId}/machines", [\App\Http\Controllers\Management\MachineController::class, 'store'])->middleware('auth')->can('admin')->name('management.machines.store');
Route::get("management/{orgId}/laundries/{laundryId}/machines/{id}", [\App\Http\Controllers\Management\MachineController::class, 'show'])->middleware('auth')->can('admin')->name('management.machines.show');
Route::get("management/{orgId}/laundries/{laundryId}/machines/{id}/edit", [\App\Http\Controllers\Management\MachineController::class, 'edit'])->middleware('auth')->can('admin')->name('management.machines.edit');
Route::put("management/{orgId}/laundries/{laundryId}/machines/{id}", [\App\Http\Controllers\Management\MachineController::class, 'update'])->middleware('auth')->can('admin')->name('management.machines.update');
Route::delete("management/{orgId}/laundries/{laundryId}/machines/{id}", [\App\Http\Controllers\Management\MachineController::class, 'destroy'])->middleware('auth')->can('admin')->name('management.machines.destroy');

// USER
Route::get("user", [UserController::class, 'index'])->middleware('auth')->name('user.index');
Route::put("user/name", [UserController::class, 'updateName'])->middleware('auth')->name('user.name');
Route::put("user/password", [UserController::class, 'updatePassword'])->middleware('auth')->name('user.password');
Route::put("user/email", [UserController::class, 'updateEmail'])->middleware('auth')->name('user.email');
Route::delete("user", [UserController::class, 'destroy'])->middleware('auth')->name('user.index');
