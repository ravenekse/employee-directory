<?php

namespace App\Http\Controllers\Add;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Users;
use App\Notifications\WelcomeNewEmployee;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AddEmployee extends Controller
{
    private Users $users;
    private Departments $departments;

    public function __construct(Users $users, Departments $departments)
    {
        $this->users = $users;
        $this->departments = $departments;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $pageData["departments"] = $this->departments->get();

        return view("pages.add.add-employee", $pageData);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function form(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->post(), [
            "firstname" => "required|string|max:255",
            "surname" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "phone_number" => "required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10",
            "description" => "string|nullable",
            "departments" => "required",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = (object) $validator->validated();

        if ($request->image && !in_array($request->image->getMimeType(), ["image/jpg", "image/jpeg", "image/png"])) {
            return redirect()
                ->back()
                ->withErrors(["image" => "Obrazek musi być w formacie .jpg lub .png"])
                ->withInput();
        }

        if($request->image) {
            $imageName =
                Str::random() .
                "_" .
                Carbon::createFromTimestamp(now()->unix())->format("d_m_Y_H_i") .
                "." .
                $request->image->extension();
            // $request->image->move(public_path("uploads/images"), $imageName);

            $file = $request->file('image');
            Storage::disk('public')->put("uploads/images/{$imageName}", $file);
        }

        $password = Str::random();

        $user = $this->users->create([
            "email" => $form->email,
            "password" => Hash::make($password),
            "firstname" => $form->firstname,
            "surname" => $form->surname,
            "phone_number" => trim($form->phone_number),
            "image_url" => $request->image ? url("uploads/images/{$imageName}") : null,
            "description" => $form->description,
        ]);

        $user->assignRole("employee");
        $user->departments()->attach(array_map("intval", $form->departments));

        $mailData = (object) [
            "firstname" => $user->firstname,
            "surname" => $user->surname,
            "email" => $user->email,
            "password" => $password,
        ];

        $user->notify(new WelcomeNewEmployee($mailData));

        return redirect()
            ->route("employees.show-employee", ["employee_id" => $user->id])
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Pomyślnie dodano pracownika {$user->firstname} {$user->surname}",
            ]);
    }
}
