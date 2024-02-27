<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function user()
    {
        return response()->json(Auth::user());
    }

    public function update_user(Request $request, $id)
    {
        $update = User::findOrFail($id);
        $update->update($request->all());
        if ($request->password != '') {
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $update->password = Hash::make($request->password);
            $update->update();
        }
        return response()->json(['messages' => 'data berhasil diubah']);
    }
}
