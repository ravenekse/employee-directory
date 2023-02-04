<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ShowEmployee extends Controller
{
    private Users $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    /**
     * @param $employee_id
     * @return View|Factory|Application
     */
    public function employee($employee_id): View|Factory|Application
    {
        if (
            !($employee = $this->users
                ->where("id", $employee_id)
                ->role("employee")
                ->first())
        ) {
            return abort(404);
        }

        $pageData["employee"] = $employee;

        return view("pages.show-employee", $pageData);
    }
}
