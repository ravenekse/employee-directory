<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments as DepartmentsModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

        return view("pages.admin.departments", $pageData);
    }
}
