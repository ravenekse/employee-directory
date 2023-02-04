<?php

namespace App\Http\Controllers\Admin\Remove;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RemoveDepartment extends Controller
{
    private Departments $departments;

    public function __construct(Departments $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @param $department_id
     * @return RedirectResponse
     */
    public function remove($department_id): RedirectResponse
    {
        if (!$department_id) {
            return abort(404);
        }

        if (!($department = $this->departments->where("id", $department_id)->first())) {
            return redirect()
                ->back()
                ->with("NOTIFICATION", [
                    "type" => "danger",
                    "message" => "Usuwanie nie powiodło się. Dział nie istnieje",
                ]);
        }

        $department->delete();

        return redirect()
            ->back()
            ->with("NOTIFICATION", [
                "type" => "success",
                "message" => "Wybrany dział został usunięty",
            ]);
    }
}
