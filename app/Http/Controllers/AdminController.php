<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function viewUserManagement()
    {
        return view('admin.user-management.user-management');
    }
}
