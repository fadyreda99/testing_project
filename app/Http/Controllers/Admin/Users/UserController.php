<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
//        $this->middleware('checkPermission:add_user')->only(['create', 'store']);
//        $this->middleware('checkPermission:edit_user')->only(['edit', 'update']);
//        $this->middleware('checkPermission:delete_user')->only(['destroy']);
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        //gate
//        Gate::forUser(Auth::guard('admin')->user())->authorize('add_user');

        //policy
//        if(Auth::guard('admin')->user()->cannot('add_user')){
//            abort(403);
//        }
        //this syntax available work with policy
        Gate::forUser(Auth::guard('admin')->user())->authorize('add_user');
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
//        Gate::forUser(Auth::guard('admin')->user())->authorize('add_user');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
//        Gate::forUser(Auth::guard('admin')->user())->authorize('edit_user');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
//        Gate::forUser(Auth::guard('admin')->user())->authorize('edit_user');
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
//        Gate::forUser(Auth::guard('admin')->user())->authorize('delete_user');
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
