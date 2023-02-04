<?php

namespace App\Http\Controllers\Admin\Add;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AddDepartment extends Controller
{
    private Departments $departments;

    public function __construct(Departments $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view("pages.admin.add.add_department");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function form(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->post(), [
            "department_name" => "required|string|max:255",
            "department_description" => "required|string",
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $form = (object) $validator->validated();

        $this->departments->create([
            "name" => $form->department_name,
            "description" => $form->department_description,
        ]);

        return redirect()
            ->route("admin.departments")
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Pomyślnie dodano dział o nazwie {$form->department_name}",
            ]);
    }
}
