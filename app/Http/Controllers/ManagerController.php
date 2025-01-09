<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function viewDashboard()
    {
        return view('manager.manager-dashboard');
    }
}
