<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit($nama)
    {
        $edit = Admin::where('nama', $nama)->first();
        return view('admin.profile.profile_edit', compact('edit'));
    }

    public function update(Request $request, $nama)
    {

        $admin_update = Admin::where('nama', $nama)->first();
        $admin_update->nama = $request->nama;
        $admin_update->email = $request->email;

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $admin_update->password = Hash::make($request->password);
        }
        $admin_update->update();
        return redirect()->route('admin_dashboard')->with('success', 'Profile sudah di update');
    }
}
