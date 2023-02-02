<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return redirect()->route("auth.login.index");
});

Route::prefix("auth")
    ->middleware("guest")
    ->group(function () {
        Route::prefix("login")->group(function () {
            Route::get("/", [LoginController::class, "index"])->name("auth.login.index");
            Route::post("form", [LoginController::class, "form"])->name("auth.login.form");
        });
    });

Route::prefix("admin")
    ->middleware("auth")
    ->group(function () {
        Route::get("dashboard", [DashboardController::class, "index"])->name("admin.dashboard");
    });
