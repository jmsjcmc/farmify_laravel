<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\FarmOwner;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function viewDashboard()
    {
        return view('admin.admin-dashboard');
    }

    public function viewUserManagement(Request $request)
    {
        $search = $request->input('search');
        $users = User::with('roles')
        ->when($search, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->paginate(10)
        ->withQueryString();
        $farmOwners = FarmOwner::with('user')
        ->when($search, function($query, $search){
            $query->whereHas('user', function($q) use ($search) {
                $q->where('first_name','like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            })
            ->orWhere('farm_name', 'like', "%{$search}%")
            ->orWhere('business_permit_number', 'like', "%{$search}%");
        })
        ->paginate(10)
        ->withQueryString();
        return view('admin.user-management.user-management', compact('users', 'farmOwners'));
    }


    public function addUser(Request $request)
    {
        $validate = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
           $image = $request->file('profile_image');
           $imageName = time() . '_' . $image->getClientOriginalName();
           $image->storeAs('public/images/profile', $imageName);
           $validate['profile_image'] = asset('storage/images/profile/' . $imageName);
        } else {
            $validate['profile_image'] = asset('storage/images/profile/default-avatar.png');
        }

        $user = User::create($validate);
        $user->assignRole($validate['role']);

        return redirect()->route('admin.user-management')->with('success', 'User added successfully');
    }

    public function updateUser(Request $request, User $user)
    {
        $validate = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'nullable|min:8',
            'role' => 'required|exists:roles,name',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::delete('public/images/profile/' . $user->profile_image);
            }

            $image = $request->file('profile_image');
            $imageName = time() - '_' . $image->getClientOriginalName();
            $image->storeAs('public/images/profile', $imageName);
            $validate['profile_image'] = asset('storage/images/profile/' . $imageName);
        }

        if (empty($validate['password'])) {
            unset($validate['password']);
        }

        $user->update($validate);
        $user->syncRoles([$validate['role']]);

        return redirect()->route('admin.user-management')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        if($user->profile_image){
            Storage::delete('public/images/profile/' . $user->profile_image);
        }
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function editUser(User $user)
    {
        return response()->json($user->load('roles'));
    }

    public function viewOwnerManagement()
    {
        return view('admin.owner-registration.owner-management');
    }

    public function approveFarmOwner(Request $request, FarmOwner $farmOwner)
    {
        $farmOwner -> update([
            'status' => 'Approved',
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        $farmOwner->user->assignRole('Farm Owner');
        return response()->json([
            'success' => true,
            'message' => 'Farm owner approved successfully'
        ]);
    }

    public function rejectFarmOwner(Request $request, FarmOwner $farmOwner)
    {
        $request -> validate([
            'rejection_reason' => 'required|string|max:255'
        ]);

        $farmOwner -> update([
            'status' => 'Rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Farm owner rejected successfully'
        ]);
    }


    public function viewDocument($type, FarmOwner $farmOwner)
    {
        $path = null;
        if ($type === 'permit') {
            $path = $farmOwner->business_permit_image;
        } elseif ($type === 'id') {
            $path = $farmOwner->valid_id_image;
        }

        if (!$path || !Storage::exists($path)) {
            abort(404);
        }

        return response()->file(Storage::path($path));
    }
}
