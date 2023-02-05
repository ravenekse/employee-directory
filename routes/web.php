<?php

use App\Http\Controllers\AccountSettings;
use App\Http\Controllers\Add\AddDepartment;
use App\Http\Controllers\Add\AddEmployee;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Departments;
use App\Http\Controllers\Remove\RemoveDepartment;
use App\Http\Controllers\Remove\RemoveEmployee;
use App\Http\Controllers\ShowDepartment;
use App\Http\Controllers\ShowEmployee;
use App\Http\Controllers\Employees;
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

Route::prefix("auth")->group(function () {
    Route::prefix("login")
        ->middleware("guest")
        ->group(function () {
            Route::get("/", [LoginController::class, "index"])->name("auth.login.index");
            Route::post("form", [LoginController::class, "form"])->name("auth.login.form");
        });

    Route::get("logout", [LogoutController::class, "logout"])->name("auth.logout");
});

Route::middleware("auth")->group(function () {
    Route::get("/home", function () {
        return redirect()->route("departments");
    })->name("home");

    Route::prefix("departments")->group(function () {
        Route::get("/", [Departments::class, "index"])->name("departments");
        Route::get("department/{department_id}", [ShowDepartment::class, "department"])->name(
            "departments.show-department"
        );

        Route::prefix("add")
            ->middleware("is-admin")
            ->group(function () {
                Route::get("/", [AddDepartment::class, "index"])->name("departments.add");
                Route::post("form", [AddDepartment::class, "form"])->name("departments.add.form");
            });

        Route::get("remove/{department_id}", [RemoveDepartment::class, "remove"])
            ->name("departments.remove")
            ->middleware("is-admin");
    });

    Route::prefix("employees")->group(function () {
        Route::get("/", [Employees::class, "index"])
            ->name("employees")
            ->middleware("is-admin");
        Route::get("employee/{employee_id}", [ShowEmployee::class, "employee"])->name("employees.show-employee");

        Route::prefix("add")
            ->middleware("is-admin")
            ->group(function () {
                Route::get("/", [AddEmployee::class, "index"])->name("employees.add");
                Route::post("form", [AddEmployee::class, "form"])->name("employess.add.form");
            });

        Route::get("remove/{employee_id}", [RemoveEmployee::class, "remove"])
            ->name("employees.remove")
            ->middleware("is-admin");
    });

    Route::prefix("account-settings")->group(function () {
        Route::get("/", [AccountSettings::class, "index"])->name("account-settings");
        Route::post("change-details", [AccountSettings::class, "changeDetails"])->name(
            "account-settings.change-details.form"
        );
        Route::post("change-password", [AccountSettings::class, "changePassword"])->name(
            "account-settings.change-password.form"
        );
    });
});
