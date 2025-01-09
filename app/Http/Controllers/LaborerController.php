<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaborerController extends Controller
{
    public function viewDashboard()
    {
        return view('laborer.laborer-dashboard');
    }
}
