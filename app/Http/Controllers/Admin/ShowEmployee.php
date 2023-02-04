<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class ShowEmployee extends Controller
{
    private Users $users;

    public function __construct(Users $users)
    {
        $this->users = $users;
    }

    public function employee($employee_id)
    {
        if (!$employee_id) {
            return abort(404);
        }

        if (
            !($employee = $this->users
                ->where("id", $employee_id)
                ->role("employee")
                ->first())
        ) {
            return abort(404);
        }

        return dd($employee);
    }
}
