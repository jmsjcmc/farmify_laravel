<?php

namespace App\Http\Controllers;

use App\Models\FarmOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function registerFarmOwner(Request $request)
    {
        $request->validate([
            'farm_name' => 'required|string|max:255',
            'farm_address' => 'required|string|max:255',
            'farm_size' => 'required|string|max:255',
            'farm_type' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
            'farm_description' => 'nullable|string',
            'business_permit_number' => 'required|string|unique:farm_owners,business_permit_number',
            'business_permit_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'valid_id_type' => 'required|string|max:255',
            'valid_id_number' => 'required|string|unique:farm_owners,valid_id_number',
            'valid_id_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $businessPermitPath = $request->file('business_permit_image')->store('public/farm_documents/permits');
        $businessPermitName = str_replace('public/', '', $businessPermitPath);


        $validIdPath = $request->file('valid_id_image')->store('public/farm_documents/ids');
        $validIdName = str_replace('public/', '', $validIdPath);


        $farmOwner = FarmOwner::create([
            'user_id' => Auth::id(),
            'farm_name' => $request->farm_name,
            'farm_address' => $request->farm_address,
            'farm_size' => $request->farm_size,
            'farm_type' => $request->farm_type,
            'contact_number' => $request->contact_number,
            'farm_description' => $request->farm_description,
            'business_permit_number' => $request->business_permit_number,
            'business_permit_image' => $businessPermitName,
            'valid_id_type' => $request->valid_id_type,
            'valid_id_number' => $request->valid_id_number,
            'valid_id_image' => $validIdName,
            'status' => 'PENDING'
        ]);


        return redirect()->route('consumer.dashboard')
            ->with('success', 'Farm owner registration submitted successfully. Please wait for admin approval.');
    }
}
