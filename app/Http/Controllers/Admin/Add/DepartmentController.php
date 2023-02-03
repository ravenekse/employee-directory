<?php

namespace App\Http\Controllers\Admin\Add;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
}
