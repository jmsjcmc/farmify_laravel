<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
            'role' => 'required|exists:roles,name'
        ]);

        $user = User::create($validate);
        $user->assignRole($validate['role']);

        return redirect()->back()->with('success', 'User added successfully');
    }

    public function updateUser(Request $request, User $user)
    {
        $validate = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name'
        ]);

        $user->update($validate);
        $user->syncRoles([$validate['role']]);

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
