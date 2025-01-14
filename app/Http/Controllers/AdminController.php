<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
        ->paginate(10);
        // ->withQueryString();
        return view('admin.user-management.user-management', compact('users'));
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
}
