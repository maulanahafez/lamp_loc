<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StreetlightController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('auth/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::controller(StreetlightController::class)->middleware('auth')->group(function () {
    Route::get('streetlight/', 'index')->name('streetlight.index');
    Route::get('streetlight/data', 'data')->name('streetlight.data');
    Route::get('streetlight/create', 'create')->name('streetlight.create');
    Route::post('streetlight/store', 'store')->name('streetlight.store');
    Route::get('streetlight/{streetlight}/edit', 'edit')->name('streetlight.edit');
    Route::put('streetlight/{streetlight}/update', 'update')->name('streetlight.update');
    Route::delete('streetlight/destroy', 'destroy')->name('streetlight.destroy');
});

Route::controller(ReportController::class)->middleware('auth')->group(function () {
    Route::get('report/', 'index')->name('report.index');
    Route::post('report/data', 'data')->name('report.data');
    Route::get('report/create', 'create')->name('report.create');
    Route::post('report/store', 'store')->name('report.store');
    Route::get('report/{report}/edit', 'edit')->name('report.edit');
    Route::put('report/{report}/update', 'update')->name('report.update');
    Route::delete('report/destroy', 'destroy')->name('report.destroy');
});
