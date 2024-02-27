<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FrontProfileController extends Controller
{
    public function profile($name)
    {
        $page = 'Photo';
        $show = User::where('name', $name)->first();

        if ($show != null) {
            // Jika user ditemukan, ambil semua post yang dimilikinya
            $post = Post::where('user_id', $show->id)
                ->whereHas('rCategory', function ($query) {
                    $query->where('id', 3);
                })
                ->latest()
                ->with('rUser')
                ->paginate(8);

            return view('frontend.profile.profile_show', compact('post', 'show', 'page'));
        } else {
            // Handle jika user tidak ditemukan
            echo "gagal";
        }
    }

    public function profile_video($name)
    {
        $page = 'Video';
        $show = User::where('name', $name)->first();

        if ($show) {
            // Jika user ditemukan, ambil semua post yang dimilikinya
            $post = Post::where('user_id', $show->id)
                ->whereHas('rCategory', function ($query) {
                    $query->where('id', 4);
                })
                ->latest()
                ->with('rUser')
                ->paginate(8);

            return view('frontend.profile.profile_show', compact('post', 'show', 'page'));
        } else {
            // Handle jika user tidak ditemukan
            echo "gagal";
        }
    }
    public function profile_audio($name)
    {
        $page = 'Audio';
        $show = User::where('name', $name)->first();

        if ($show) {
            // Jika user ditemukan, ambil semua post yang dimilikinya
            $post = Post::where('user_id', $show->id)
                ->whereHas('rCategory', function ($query) {
                    $query->where('id', 5);
                })
                ->latest()
                ->with('rUser')
                ->paginate(8);

            return view('frontend.profile.profile_show', compact('post', 'show', 'page'));
        } else {
            // Handle jika user tidak ditemukan
            echo "gagal";
        }
    }
    public function edit($name)
    {
        $page = 'edit';
        // $edit = User::where('name', $name)->first();
        $show = User::where('name', $name)->first();
        return view('frontend.profile.profile_edit', compact('page', 'show'));
    }

    public function update(Request $request, $name)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'hp' => 'required',
            'status' => 'required',
            'foto_profil' => 'mimes:png,jpg,jpeg',
        ]);

        $update = User::where('name', $name)->first();

        if ($update) {
            $update->name = $request->name;
            $update->nim = $request->nim;
            $update->gender = $request->gender;
            $update->skill = $request->skill;
            $update->email = $request->email;
            $update->hp = $request->hp;
            $update->about = $request->about;
            $update->instagram = $request->instagram;
            $update->twitter = $request->twitter;
            $update->status = $request->status;
            $update->place = $request->place;
            $update->contract = $request->contract;

            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $ext = $file->getClientOriginalExtension();

                if ($update->foto_profil == '') {
                    if (storage_path('app/public/uploads/photo/profil')) {
                        if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                            $ext = $request->file('foto_profil')->extension();
                            $final = 'profil' . time() . '.' . $ext;

                            // menyimpan gambar asli
                            $request->file('foto_profil')->move(storage_path('app/public/uploads/photo/profil/'), $final);
                            $update->foto_profil = $final;
                        }
                    }
                } elseif ($update->foto_profil) {
                    unlink(storage_path('app/public/uploads/photo/profil/' . $update->foto_profil));
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                        $ext = $request->file('foto_profil')->extension();
                        $final = 'profil' . time() . '.' . $ext;

                        // menyimpan gambar asli
                        $request->file('foto_profil')->move(storage_path('app/public/uploads/photo/profil'), $final);
                        $update->foto_profil = $final;
                    }
                }
            }

            if (!empty($request->password)) {
                $request->validate([
                    'password' => 'required|confirmed',
                ]);
                $update->password = Hash::make($request->password);
            }

            $update->save();
            return redirect()->route('profile', [$update->name])->with('success', 'Profil berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Profil tidak ditemukan');
        }
    }
}
