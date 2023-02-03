<?php

use App\Http\Controllers\Admin\Add\DepartmentController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
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

    //    $department = \App\Models\Departments::first();
    //    foreach ($department->users as $user) {
    //        echo "{$user->firstname} {$user->surname} <br>";
    //    }
});

Route::prefix("auth")->group(function () {
    Route::prefix("login")
        ->group(function () {
            Route::get("/", [LoginController::class, "index"])->name("auth.login.index");
            Route::post("form", [LoginController::class, "form"])->name("auth.login.form");
        })
        ->middleware("guest");

    Route::get("logout", [LogoutController::class, "logout"])->name("auth.logout");
});

Route::prefix("admin")
    ->middleware("auth")
    ->group(function () {
        Route::get("/", function () {
            return redirect()->route("admin.departments");
        })->name("admin.home");

        Route::prefix("departments")->group(function () {
            Route::get("/", [DepartmentsController::class, "index"])->name("admin.departments");

            Route::prefix("add")->group(function () {
                Route::get("/", [DepartmentController::class, "index"])->name("admin.add.department");
            });
        });
    });
