<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ShowDepartment extends Controller
{
    private Departments $departments;

    public function __construct(Departments $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @param $department_id
     * @return View|Factory|Application
     */
    public function department($department_id): View|Factory|Application
    {
        if (!($department = $this->departments->where("id", $department_id)->first())) {
            return abort(404);
        }

        $pageData["department"] = $department;

        return view("pages.show-department", $pageData);
    }
}
