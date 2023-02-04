<?php

namespace App\Http\Controllers\Remove;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RemoveEmployee extends Controller
{
    private Users $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * @param $employee_id
     * @return RedirectResponse
     */
    public function remove($employee_id): RedirectResponse
    {
        if (!($user = $this->users->where("id", $employee_id)->first())) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Usuwanie nie powiodło się. Pracownik nie istnieje",
                ]);
        }

        if ($user->id === auth()->user()->id) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Nie możesz usunąć konta, na które jesteś zalogowany",
                ]);
        }

        if ($user->id === 1 && $user->hasRole("admin")) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Nie możesz usunąć super administratora",
                ]);
        }

        $user->delete();

        return redirect()
            ->back()
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Wybrany pracownik został usunięty",
            ]);
    }
}
