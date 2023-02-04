<?php

namespace App\Http\Controllers;

use App\Models\Departments as DepartmentsModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Departments extends Controller
{
    private DepartmentsModel $departments;

    public function __construct(DepartmentsModel $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $pageData = [];

        if (
            auth()
                ->user()
                ->hasRole("admin")
        ) {
            $pageData["departments"] = $this->departments->paginate(10);
        } else {
            $pageData["departments"] = auth()
                ->user()
                ->departments()
                ->paginate(10);
        }

        return view("pages.departments", $pageData);
    }
}
