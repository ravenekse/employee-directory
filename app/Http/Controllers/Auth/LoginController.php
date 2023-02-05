<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view("pages.auth.login");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function form(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->post(), [
            "email" => "required|email",
            "password" => "required|string",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->onlyInput("email");
        }

        if (!auth()->attempt($validator->validated(), $request->boolean("remember_me"))) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Podano nieprawidłowy adres e-mail lub hasło",
                ])
                ->onlyInput("email");
        }

        $user = auth()->user();

        return redirect()
            ->route("departments")
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Pomyślnie zalogowano!",
            ]);
    }
}
