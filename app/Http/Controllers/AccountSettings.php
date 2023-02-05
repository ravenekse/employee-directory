<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AccountSettings extends Controller
{
    private Users $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $pageData["user"] = auth()->user();

        return view("pages.accounts-settings", $pageData);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function changeDetails(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->post(), [
            "firstname" => "required|string|max:255",
            "surname" => "required|string|max:255",
            "email" => "required|email",
            "phone_number" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
            "description" => "string|nullable",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        if (!($user = $this->users->where("id", auth()->user()->id)->first())) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Coś poszło nie tak!",
                ]);
        }

        $form = (object) $validator->validated();

        if ($user->email !== $form->email && $this->users->where("email", $form->email)->first()) {
            return redirect()
                ->back()
                ->withErrors(["email" => "Istnieje już konto z podanym adresem e-mail"]);
        }

        if ($request->image && !in_array($request->image->getMimeType(), ["image/jpg", "image/jpeg", "image/png"])) {
            return redirect()
                ->back()
                ->withErrors(["image" => "Obrazek musi być w formacie .jpg lub .png"]);
        }

        $imageName =
            Str::random() .
            "_" .
            Carbon::createFromTimestamp(now()->unix())->format("d_m_Y_H_i") .
            "." .
            $request->image->extension();
        $request->image->move(public_path("uploads/images"), $imageName);

        $user->update(array_merge($validator->validated(), ["image_url" => url("uploads/images/{$imageName}")]));

        return redirect()
            ->back()
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Pomyślnie zaktualizowano ustawienia konta",
            ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|void
     * @throws ValidationException
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->post(), [
            "old_password" => "required|string",
            "new_password" => "required|string|min:3|max:36",
            "new_password_confirmation" => "required|string|min:3|max:36",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        if (!($user = $this->users->where("id", auth()->user()->id)->first())) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Coś poszło nie tak!",
                ]);
        }

        $form = (object) $validator->validated();

        if (!Hash::check($form->old_password, $user->password)) {
            return redirect()
                ->back()
                ->withErrors([
                    "old_password" => "Stare hasło jest nieprawidłowe",
                ]);
        }

        if ($form->new_password !== $form->new_password_confirmation) {
            return redirect()
                ->back()
                ->withErrors([
                    "new_password_confirmation" => "Podane hasła nie są identyczne",
                ]);
        }

        $user->update([
            "password" => Hash::make($form->new_password),
        ]);

        return redirect()
            ->back()
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Hasło zostało pomyślnie zmienione",
            ]);
    }
}
