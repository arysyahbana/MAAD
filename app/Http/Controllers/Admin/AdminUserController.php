<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function show()
    {
        $users = User::get();
        return view('admin.user.user_show', compact('users'));
    }

    public function create()
    {
        return view('admin.user.user_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user_store = new User();
        $user_store->name = $request->name;
        $user_store->email = $request->email;
        $user_store->password = Hash::make($request->password);
        $user_store->role = 'umum';
        $user_store->save();
        return redirect()->route('admin_user_show');
    }

    public function edit($name)
    {
        $edit = User::where('name', $name)->first();
        return view('admin.user.user_edit', compact('edit'));
    }

    public function update(Request $request, $name)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user_update = User::where('name', $name)->first();
        $user_update->name = $request->name;
        $user_update->email = $request->email;
        $user_update->role = $request->role;

        if ($request->password != '') {
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $user_update->password = Hash::make($request->new_password);
        }
        $user_update->update();
        return redirect()->route('admin_user_show');
    }

    public function delete($name)
    {
        User::where('name', $name)->delete();
        return redirect()->route('admin_user_show');
    }

    public function makepremium($name)
    {
        $update = User::where('name', $name)->first();
        $update->role = 'premium';
        $update->update();
        compact('update');
        return redirect()->route('admin_user_show');
    }
}
