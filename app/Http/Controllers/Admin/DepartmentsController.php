<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    private Departments $departments;

    public function __construct(Departments $departments)
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
                ->hasRole("user")
        ) {
            $pageData = [
                "departments" => auth()->user()->departments,
            ];
        } elseif (
            auth()
                ->user()
                ->hasRole("admin")
        ) {
            $pageData = [
                "departments" => $this->departments->all(),
            ];
        }

        return view("pages.admin.departments", $pageData);
    }
}
