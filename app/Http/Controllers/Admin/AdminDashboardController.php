<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $countUser = User::count();
        $post = Post::count();
        $category = Category::count();
        $userPremium = User::where('role', 'premium')->count();

        $photoCount = Post::where('category_id', 3)->count();
        $videoCount = Post::where('category_id', 4)->count();
        $audioCount = Post::where('category_id', 5)->count();

        $usersWithPostCount = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', DB::raw('count(posts.id) as post_count'))
            ->groupBy('users.id')
            ->orderBy('post_count', 'desc') // Mengurutkan berdasarkan post_count secara descending
            ->take(5) // Mengambil 5 hasil pertama
            ->get();

        $usersNIM = $usersWithPostCount->map(function ($user) {
            $nim = $user->nim;

            // Mengambil dua angka di depan NIM
            $user->formatted_nim = '20' . substr($nim, 0, 2);

            return $user;
        });

        $userPost = User::leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select(
                'users.*',
                DB::raw('count(posts.id) as post_count'),
                DB::raw('count(case when posts.category_id = 3 then 1 else null end) as photo_count'),
                DB::raw('count(case when posts.category_id = 4 then 1 else null end) as video_count'),
                DB::raw('count(case when posts.category_id = 5 then 1 else null end) as audio_count'),
            )
            ->groupBy('users.id')
            ->orderBy('post_count', 'desc') // Mengurutkan berdasarkan post_count secara descending
            ->get();

        $userNIM = $userPost->map(function ($user) {
            $nim = $user->nim;

            // Mengambil dua angka di depan NIM
            $user->formatted_nim = '20' . substr($nim, 0, 2);

            return $user;
        });

        return view('admin.index', compact('countUser', 'post', 'category', 'userPremium', 'photoCount', 'videoCount', 'audioCount', 'usersWithPostCount', 'usersNIM', 'userPost', 'userNIM'));
    }
}
