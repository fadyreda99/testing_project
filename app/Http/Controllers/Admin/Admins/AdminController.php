<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $admin->assignRole($request->role);
        return redirect()->route('admin.admins.index')->with('success', 'admin created successfully.');
    }

    public function edit(Admin $admin)
    {
        $roles = Role::where('guard_name', 'admin')->get();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required'
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);
        $admin->syncRoles($request->role);

        return redirect()->route('admin.admins.index')->with('success', 'admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        Log::channel('slack')->alert('admin is deleted with id ' . $admin->id);
        return redirect()->route('admin.admins.index')->with('success', 'admin deleted successfully.');
    }
}
