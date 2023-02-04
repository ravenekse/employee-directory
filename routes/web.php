<?php

use App\Http\Controllers\Admin\Add\AddDepartment;
use App\Http\Controllers\Admin\Departments;
use App\Http\Controllers\Admin\Remove\RemoveDepartment;
use App\Http\Controllers\Admin\ShowEmployee;
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
            Route::get("/", [Departments::class, "index"])->name("admin.departments");

            Route::prefix("add")
                ->middleware("is-admin")
                ->group(function () {
                    Route::get("/", [AddDepartment::class, "index"])->name("admin.departments.add");
                    Route::post("form", [AddDepartment::class, "form"])->name("admin.departments.add.form");
                });

            Route::get("remove/{department_id}", [RemoveDepartment::class, "remove"])
                ->name("admin.departments.remove")
                ->middleware("is-admin");
        });

        Route::get("employee/{employee_id}", [ShowEmployee::class, "employee"])->name("auth.show-employee");
    });
