<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsumerController extends Controller
{
    public function viewDashboard()
    {
        return view('consumer.consumer-dashboard');
    }

    public function viewSetting()
    {
        return view('consumer.consumer-setting.consumer-setting');
    }

    public function viewAccount()
    {
        return view('consumer.consumer-setting.consumer-account');
    }

    public function viewRegisterFarmOwner()
    {
        return view('consumer.consumer-setting.register-farm-owner');
    }
}
