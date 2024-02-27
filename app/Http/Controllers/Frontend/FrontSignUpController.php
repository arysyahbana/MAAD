<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FrontSignUpController extends Controller
{
    public function signup()
    {
        return view('frontend.signup.front_signup');
    }

    public function store(Request $request)
    {
        $store = new User();
        $token = hash('sha256', time());
        $store->token = $token;
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'hp' => 'required',
            'nim' => 'required|unique:users,nim',
            'gender' => 'required',
            'password' => 'required|confirmed'
        ]);

        $store->name = $request->name;
        $store->email = $request->email;
        $store->hp = $request->hp;
        $store->nim = $request->nim;
        $store->gender = $request->gender;
        $store->role = 'umum';
        $store->password = Hash::make($request->password);

        $verif_link = url('signup/verification/' . $token . '/' . $request->email);
        $subject = 'Verifikasi Email Akun MAD';
        $message = 'klik link <a href="' . $verif_link . '">ini</a> untuk mengaktifkan akun anda';
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        $store->save();
        return redirect()->route('user_signup')->with('success', 'check your email');
    }

    public function verif($token, $email)
    {
        $verif = User::where('token', $token)->where('email', $email)->first();

        if ($verif) {
            // dd($verif, $token, $email);
            $verif->update(['token' => null]);
            // dd($verif);
            // die;
            return redirect()->route('home')->with('success', 'verifikasi berhasil');
        } else {
            // Handle the case where no matching user is found
            return redirect()->route('home')->with('success', 'verifikasi berhasil');
        }
    }
}
