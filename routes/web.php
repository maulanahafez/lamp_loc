<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StreetlightController;
use App\Http\Controllers\StreetlightGroupController;
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
    Route::get('home/get_streetlights', 'get_streetlights')->name('home.get_streetlights');
    Route::post('home/report_issue', 'report_issue')->name('home.report_issue');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('auth/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::controller(StreetlightController::class)->middleware('auth')->group(function () {
    Route::get('streetlight/', 'index')->name('streetlight.index');
    Route::get('streetlight/data', 'data')->name('streetlight.data');
    Route::get('streetlight/create', 'create')->name('streetlight.create');
    Route::post('streetlight/store', 'store')->name('streetlight.store');
    Route::post('streetlight/set_session', 'set_session')->name('streetlight.set_session');
    Route::post('streetlight/clear_session', 'clear_session')->name('streetlight.clear_session');
    Route::get('streetlight/get_streetlight', 'get_streetlight')->name('streetlight.get_streetlight')->withoutMiddleware('auth');
    Route::post('streetlight/get_streetlight_scan', 'get_streetlight_scan')->name('streetlight.get_streetlight_scan')->withoutMiddleware('auth');
    Route::get('streetlight/{streetlight}/show', 'show')->name('streetlight.show');
    Route::get('streetlight/{streetlight}/edit', 'edit')->name('streetlight.edit');
    Route::put('streetlight/{streetlight}/update', 'update')->name('streetlight.update');
    Route::delete('streetlight/{streetlight}/destroy', 'destroy')->name('streetlight.destroy');
});

Route::controller(StreetlightGroupController::class)->middleware('auth')->group(function () {
    Route::get('streetlight_group/', 'index')->name('streetlight_group.index');
    Route::get('streetlight_group/get_groups', 'get_groups')->name('streetlight_group.get_groups')->withoutMiddleware('auth');
    Route::get('streetlight_group/data', 'data')->name('streetlight_group.data');
    Route::get('streetlight_group/create', 'create')->name('streetlight_group.create');
    Route::post('streetlight_group/store', 'store')->name('streetlight_group.store');
    Route::post('streetlight_group/set_session', 'set_session')->name('streetlight_group.set_session');
    Route::post('streetlight_group/clear_session', 'clear_session')->name('streetlight_group.clear_session');
    Route::get('streetlight_group/get_streetlights', 'get_streetlights')->name('streetlight_group.get_streetlights');
    Route::get('streetlight_group/{streetlight_group}/edit', 'edit')->name('streetlight_group.edit');
    Route::put('streetlight_group/{streetlight_group}/update', 'update')->name('streetlight_group.update');
    Route::delete('streetlight_group/{streetlight_group}/destroy', 'destroy')->name('streetlight_group.destroy');
});

Route::controller(ReportController::class)->middleware('auth')->group(function () {
    Route::get('report/', 'index')->name('report.index');
    // Route::get('report/get_groups', 'get_groups')->name('report.get_groups')->withoutMiddleware('auth');
    Route::get('report/data', 'data')->name('report.data');
    Route::get('report/create', 'create')->name('report.create');
    Route::post('report/store', 'store')->name('report.store');
    // Route::post('report/set_session', 'set_session')->name('report.set_session');
    // Route::post('report/clear_session', 'clear_session')->name('report.clear_session');
    Route::get('report/get_streetlights', 'get_streetlights')->name('report.get_streetlights');
    Route::get('report/{report}/edit', 'edit')->name('report.edit');
    Route::put('report/{report}/update', 'update')->name('report.update');
    Route::delete('report/{report}/destroy', 'destroy')->name('report.destroy');
});
