<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function viewDashboard()
    {
        return view('owner.owner-dashboard');
    }

    public function viewFarmManagement()
    {
        return view('owner.farm-management.farm-management');
    }

    public function viewJobManagement()
    {
        return view('owner.job-management.job-management');
    }
}
