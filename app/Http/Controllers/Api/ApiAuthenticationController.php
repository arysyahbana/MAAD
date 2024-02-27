<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Mail\Websitemail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ApiAuthenticationController extends Controller
{

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $token = hash('sha256', time());

        $store = new User();
        $store->name = $request->input('name');
        $store->email = $request->input('email');
        $store->password = Hash::make($request->input('password')); // hash password dengan bcrypt
        $store->token = $token;
        $store->save();

        $verif = url('api/signup/' . $token . '/' . $request->email);
        $subject = 'Verifikasi akun UNP Asset';
        $message = 'klik link <a href="' . $verif . '">ini</a>';
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return response()->json($store);
    }
    public function verif($token, $email)
    {
        $verif = User::where('token', $token)->where('email', $email)->first();
        if ($verif) {
            $verif->token = '';
            $verif->update();
            return response()->json("email anda berhasil diverifikasi");
        }

        return response()->json("email tidak ditemukan");
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credential are incorrect'],
            ]);
        }

        return $user->createToken('user login')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json("Telah Logout");
    }

    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }
}
