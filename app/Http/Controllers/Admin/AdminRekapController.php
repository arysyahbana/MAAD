<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserRekapExport;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminRekapController extends Controller
{
    public function show(Request $request)
    {
        // $users = User::all();
        // $post = Post::count();
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
            ->get();;

        // Mendapatkan Tahun Masuk
        $userNIM = $userPost->map(function ($user) {
            $nim = $user->nim;

            // Mengambil dua angka di depan NIM
            $user->formatted_nim = '20' . substr($nim, 0, 2);

            return $user;
        });

        // Memilah data berdasarkan tahun masuk
        // Dapatkan tahun masuk yang berbeda dari NIM
        $distinctYears = $userPost->pluck('formatted_nim')->unique();

        // Dapatkan tahun yang dipilih dari permintaan
        $selectedYear = $request->input('tahun_masuk');

        // Saring pengguna berdasarkan tahun yang dipilih
        if ($selectedYear) {
            $userPost = $userPost->filter(function ($user) use ($selectedYear) {
                return $user->formatted_nim == $selectedYear;
            });
        }

        // Excel Download
        if ($request->has('export_excel')) {
            $year = $selectedYear;
            $fileName = 'user_rekap_' . $year . '.xlsx';

            return Excel::download(new UserRekapExport($userPost), $fileName);
        } elseif ($request->has('export_excel_all')) {
            $fileName = 'user_rekap_all.xlsx';

            return Excel::download(new UserRekapExport($userPost), $fileName);
        }

        return view('admin.rekap.rekap', compact('userNIM', 'userPost', 'distinctYears', 'selectedYear'));
    }
}
