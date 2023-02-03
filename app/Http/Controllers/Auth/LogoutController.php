<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        if (!auth()->check()) {
            return abort(404);
        }

        auth()->logout();

        return redirect()
            ->route("auth.login.index")
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Pomyślnie wylogowano",
            ]);
    }
}
