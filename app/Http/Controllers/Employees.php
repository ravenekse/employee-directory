<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\Users as UsersModel;

class Employees extends Controller
{
    private UsersModel $users;

    public function __construct(UsersModel $users)
    {
        $this->users = $users;
    }

    /**
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $pageData["employees"] = $this->users->role("employee")->get();

        return view("pages.employees", $pageData);
    }
}
