<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use BenSampo\Embed\Rules\EmbeddableUrl;
use Cviebrock\EloquentSluggable\Services\SlugService;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Filters\Video\VideoFilters;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Cloudinary\Api\Exception\ApiError;

// use Illuminate\Support\Facades\Storage;


class FrontPostController extends Controller
{
    public function show($name)
    {
        $page = 'showPost';
        // Cari user berdasarkan 'name'
        $user = User::where('name', $name)->first();

        if ($user) {
            // Jika user ditemukan, ambil semua post yang dimilikinya
            $data = Post::where('user_id', $user->id)->latest()->paginate(8);
            $show = User::where('name', $name)->first();
            return view('frontend.Post.front-post_show', compact('data', 'show', 'page'));
        } else {
            // Handle jika user tidak ditemukan
            echo "gagal";
        }
    }


    public function create($name)
    {
        $page = 'upload';
        $category = Category::get();
        $show = User::where('name', $name)->first();
        return view('frontend.Post.front_post_create', compact('category', 'show', 'page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'mimes:png,jpg,jpeg,mp4,mkv,webm,mp3,m4a,eps,psd,ai,aep,aepx,prproj,aup3,sesx,als,zip,rar|file|max:10240',
            'file2' => 'file|max:10240',
            'body' => 'required',
            // 'category_menu' => 'required',
            'url=' => [new EmbeddableUrl],

        ], [
            'body.required' => 'Deskripsi harus diisikan',
            'file.mimes' => 'File harus berupa gambar, video, audio',
            'title.required' => 'Judul tidak boleh kosong',
            // 'category_menu.required' => 'Pilih Kategori yang valid',
        ]);
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $store = new Post();
        $store->user_id = Auth::guard()->user()->id;
        $store->name = $request->title;
        $store->slug = $slug;
        $store->body = $request->body;
        $store->category_id = $request->category_menu;
        // dd($store);
        // die;


        if ($request->file('file')) {
            $files = $request->file('file');
            $pilkat = $store->category_id;
            $ext = $files->getClientOriginalExtension();

            // Image
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                $ext = $request->file('file')->extension();
                $final = 'photo' . time() . '.' . $ext;

                // Kompresi gambar
                $compressedImage = Image::make($files)->encode($ext, 10);
                $resolution = $compressedImage->height() . "x" . $compressedImage->width();

                $compressedImage->save(storage_path('app/public/uploads/photo/compress/') . $final);

                // menyimpan gambar asli
                $request->file('file')->move(storage_path('app/public/uploads/photo/'), $final);
                $store->resolution = $resolution;
                $store->file = $final;
            }

            // Video
            if ($ext == 'mp4' || $ext == 'mkv' || $ext == 'webm') {
                // $ext = $request->file('file')->extension();
                // $final = 'video' . time() . '.' . $ext;
                // $request->file('file')->move(storage_path('app/public/uploads/video/'), $final);
                // $store->file = $final;

                //    thumbnail video
                // $video = FFMpeg::fromDisk('video')->open($final);
                // $thumbnail = 'thumb' . time() . '.jpg';
                // $video->getFrameFromSeconds(2)
                //     ->export()
                //     ->accurate()
                //     ->save('thumbnail/' . $thumbnail);

                // $store->thumbnail = $thumbnail;
                // end thumbnail video

                // Konversi video
                // $video2 = FFMpeg::fromDisk('video')->open($final);

                // 720p
                // $q720p = '720p' . time() . '.mp4';
                // $video2->addFilter(function (VideoFilters $filters) {
                //     $filters->resize(new \FFMpeg\Coordinate\Dimension(1280, 720));
                // })
                //     ->export()
                //     ->toDisk('video')
                //     ->inFormat(new X264)
                //     ->save('720p/' . $q720p);
                // $store->q720p = $q720p;
                // end 720p

                // 480p
                // $q480p = '480p' . time() . '.mp4';
                // $video2->addFilter(function (VideoFilters $filters) {
                //     $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
                // })
                //     ->export()
                //     ->toDisk('video')
                //     ->inFormat(new X264)
                //     ->save('480p/' . $q480p);
                // $store->q480p = $q480p;
                // end 480p

                // 360p
                // $q360p = '360p' . time() . '.mp4';
                // $video2->addFilter(function (VideoFilters $filters) {
                //     $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 360));
                // })
                //     ->export()
                //     ->toDisk('video')
                //     ->inFormat(new X264)
                //     ->save('360p/' . $q360p);
                // $store->q360p = $q360p;
                // end 360p
                // end Konversi Video

                $pathVideo = 'video';
                $file = $request->file('file')->getClientOriginalName();
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $publicId = date('Y-m-d_His') . '_' . $fileName;
                $cPublicId = $pathVideo . '/' . $publicId;

                $uploadVideo = Cloudinary::uploadVideo(
                    $request->file('file')->getRealPath(),
                    [
                        "public_id" => $publicId,
                        "folder" => $pathVideo,
                    ]
                )->getSecurePath();

                // Konversi video ke kualitas 720p, 480p, dan 360p
                $path720p = 'video/720p';
                $path480p = 'video/480p';
                $path360p = 'video/360p';

                // Transformasi untuk 720p
                $upload720p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                    "public_id" => $publicId . '-720p',
                    "folder" => $path720p,
                    "transformation" => [
                        'width' => 1280,
                        'height' => 720,
                    ]
                ])->getSecurePath();

                // Transformasi untuk 480p
                $upload480p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                    "public_id" => $publicId . '-480p',
                    "folder" => $path480p,
                    "transformation" => [
                        'width' => 854,
                        'height' => 480
                    ]
                ])->getSecurePath();

                // Transformasi untuk 360p
                $upload360p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                    "public_id" => $publicId . '-360p',
                    "folder" => $path360p,
                    "transformation" => [
                        'width' => 640,
                        'height' => 360
                    ]
                ])->getSecurePath();

                $cPublicId720 = $path720p . '/' . $publicId . '-720p';
                $cPublicId480 = $path480p . '/' . $publicId . '-480p';
                $cPublicId360 = $path360p . '/' . $publicId . '-360p';

                $store->file = $uploadVideo;
                $store->q720p = $upload720p;
                $store->q480p = $upload480p;
                $store->q360p = $upload360p;
                $store->cPublicId = $cPublicId;
                $store->cPublicId720 = $cPublicId720;
                $store->cPublicId480 = $cPublicId480;
                $store->cPublicId360 = $cPublicId360;
            }

            // audio
            if ($ext == 'mp3' || $ext == 'm4a') {
                $ext = $request->file('file')->extension();
                $final = 'audio' . time() . '.' . $ext;
                $request->file('file')->move(storage_path('app/public/uploads/audio/'), $final);
                $store->file = $final;
            }
        }

        // Googledrive
        // file
        elseif ($request->has('linkgd')) {
            if (strpos($request->linkgd, 'preview') !== false) {
                $change_link = $request->linkgd;
                $store->urlgd = $change_link;
            } elseif (strpos($request->linkgd, 'view') !== false) {
                $change_link = str_replace('view', 'preview', $request->linkgd);
                $store->urlgd = $change_link;
            }
        }

        // file project
        if ($request->has('file2Link')) {
            if (strpos($request->file2Link, 'preview') !== false) {
                $change_link2 = $request->file2Link;
                $store->fpgd = $change_link2;
            } elseif (strpos($request->file2Link, 'view') !== false) {
                $change_link2 = str_replace('view', 'preview', $request->file2Link);
                $store->fpgd = $change_link2;
            }
        }
        // end Googledrive

        // YouTube
        if ($request->linkyt != null) {
            // dd('linkyt exists');

            $pilkat = 4;
            $store->category_id = 4;
            $store->url = $request->linkyt;
        }
        //end YouTube

        // Input File Project
        if ($request->file('file2')) {
            $files2 = $request->file('file2');
            $ext2 = $files2->getClientOriginalExtension();
            $pilkat = $store->category_id;
            if ($ext2 == 'eps' || $ext2 == 'psd' || $ext2 == 'ai' || $ext2 == 'cdr') {
                // $ext2 = $request->file('file2')->extension();
                $final2 = 'rawphoto' . time() . '.' . $ext2;
                $request->file('file2')->move(storage_path('app/public/uploads/rawphoto'), $final2);
                $store->file_mentah = $final2;
            }

            if ($ext2 == 'aep' || $ext2 == 'aepx' || $ext2 == 'prproj') {
                // $ext2 = $request->file('file2')->getClientOriginalExtension();
                $final2 = 'rawvideo' . time() . '.' . $ext2;
                $request->file('file2')->move(storage_path('app/public/uploads/rawvideo'), $final2);
                $store->file_mentah = $final2;
            }

            if ($ext2 == 'aup3' || $ext2 == 'sesx' || $ext2 == 'als') {
                $final2 = 'rawaudio' . time() . '.' . $ext2;
                $request->file('file2')->move(storage_path('app/public/uploads/rawaudio'), $final2);
                $store->file_mentah = $final2;
            }

            if ($ext2 == 'rar' || $ext2 == 'zip') {
                if ($pilkat == 3) {
                    $final2 = 'rawphoto' . time() . '.' . $ext2;
                    $request->file('file2')->move(storage_path('app/public/uploads/rawphoto'), $final2);
                    $store->file_mentah = $final2;
                } elseif ($pilkat == 4) {
                    $final2 = 'rawvideo' . time() . '.' . $ext2;
                    $request->file('file2')->move(storage_path('app/public/uploads/rawvideo'), $final2);
                    $store->file_mentah = $final2;
                } elseif ($pilkat == 5) {
                    $final2 = 'rawaudio' . time() . '.' . $ext2;
                    $request->file('file2')->move(storage_path('app/public/uploads/rawaudio'), $final2);
                    $store->file_mentah = $final2;
                }
            }
        }
        // end Input Project


        $store->save();
        return redirect()->back()->with('success', 'Upload Success');
    }

    // public function delete($slug)
    // {
    //     $delete = Post::where('slug', $slug)->first();

    //     if ($delete->file == '') {
    //         $delete->delete();
    //         return redirect()->back()->with('success', 'berhasil di hapus');
    //     } else {
    //         if (file_exists(storage_path('app/public/uploads/photo/' . $delete->file))) {
    //             unlink(storage_path('app/public/uploads/photo/' . $delete->file));
    //             unlink(storage_path('app/public/uploads/photo/compress/' . $delete->file));
    //         } elseif (file_exists(storage_path('app/public/uploads/video/' . $delete->file))) {
    //             unlink(storage_path('app/public/uploads/video/' . $delete->file));
    //             unlink(storage_path('app/public/uploads/video/thumbnail/' . $delete->thumbnail));
    //             unlink(storage_path('app/public/uploads/video/720p/' . $delete->q720p));
    //             unlink(storage_path('app/public/uploads/video/480p/' . $delete->q480p));
    //             unlink(storage_path('app/public/uploads/video/360p/' . $delete->q360p));
    //         } elseif (file_exists(storage_path('app/public/uploads/audio/' . $delete->file))) {
    //             unlink(storage_path('app/public/uploads/audio/' . $delete->file));
    //         } elseif (file_exists(storage_path('app/public/uploads/rawphoto/' . $delete->file))) {
    //             unlink(storage_path('app/public/uploads/rawphoto/' . $delete->file_mentah));
    //         } elseif (file_exists(storage_path('app/public/uploads/rawvideo/' . $delete->file))) {
    //             unlink(storage_path('app/public/uploads/rawvideo/' . $delete->file_mentah));
    //             // } elseif (file_exists(storage_path('app/public/uploads/rawaudio/' . $delete->file))) {
    //             //     unlink(storage_path('app/public/uploads/rawaudio/' . $delete->file_mentah));
    //         }
    //         $delete->delete();
    //         return redirect()->back()->with('success', 'berhasil di hapus');
    //     }
    // }

    // public function view($id, $name)
    // {
    //     $view = Post::where('id', $id)->where('name', $name)->first();
    //     return view('detail', compact('view'));
    // }

    public function delete($slug)
    {
        $delete = Post::where('slug', $slug)->first();

        if (!$delete) {
            return redirect()->back()->with('error', 'Postingan tidak ditemukan.');
        }

        $publicId = $delete->cPublicId;
        $publicId720 = $delete->cPublicId720;
        $publicId480 = $delete->cPublicId480;
        $publicId360 = $delete->cPublicId360;

        $filePaths = [];

        if ($delete->file != '') {
            $extension = pathinfo($delete->file, PATHINFO_EXTENSION);

            if (in_array($extension, ['jpg', 'png', 'jpeg', 'gif', 'eps', 'psd', 'ai'])) {
                $filePaths = array_merge($filePaths, [
                    'public/uploads/photo/' . $delete->file,
                    'public/uploads/photo/compress/' . $delete->file,
                    'public/uploads/rawphoto/' . $delete->file_mentah,
                ]);
            } elseif (in_array($extension, ['mp4', 'avi', 'mov', 'aep', 'aepx', 'prproj'])) {
                $filePaths = array_merge($filePaths, [
                    // 'public/uploads/video/' . $delete->file,
                    // 'public/uploads/video/thumbnail/' . $delete->thumbnail,
                    // 'public/uploads/video/720p/' . $delete->q720p,
                    // 'public/uploads/video/480p/' . $delete->q480p,
                    // 'public/uploads/video/360p/' . $delete->q360p,
                    'public/uploads/rawvideo/' . $delete->file_mentah,
                ]);
                // Hapus dari Cloudinary
                Cloudinary::destroy($publicId, ['resource_type' => 'video']);
                Cloudinary::destroy($publicId720, ['resource_type' => 'video']);
                Cloudinary::destroy($publicId480, ['resource_type' => 'video']);
                Cloudinary::destroy($publicId360, ['resource_type' => 'video']);
            } elseif (in_array($extension, ['mp3', 'm4a', 'wav', 'aup3', 'sesx', 'als'])) {
                $filePaths = array_merge($filePaths, [
                    'public/uploads/audio/' . $delete->file,
                    'public/uploads/rawaudio/' . $delete->file_mentah,
                ]);
            }
        }

        foreach ($filePaths as $filePath) {
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        if ($delete->url) {
            $delete->url = null;
            if (Storage::exists('public/uploads/rawvideo/' . $delete->file_mentah)) {
                Storage::delete('public/uploads/rawvideo/' . $delete->file_mentah);
            }
        }

        if ($delete->urlgd) {
            $delete->urlgd = null;
            if ($delete->category_id == 3) {
                if (Storage::exists('public/uploads/rawphoto/' . $delete->file_mentah)) {
                    Storage::delete('public/uploads/rawphoto/' . $delete->file_mentah);
                }
            } elseif ($delete->category_id == 4) {
                if (Storage::exists('public/uploads/rawvideo/' . $delete->file_mentah)) {
                    Storage::delete('public/uploads/rawvideo/' . $delete->file_mentah);
                }
            } elseif ($delete->category_id == 5) {
                if (Storage::exists('public/uploads/rawaudio/' . $delete->file_mentah)) {
                    Storage::delete('public/uploads/rawaudio/' . $delete->file_mentah);
                }
            }
        }

        $delete->delete();
        return redirect()->back()->with('success', 'Postingan dan file terkait berhasil dihapus.');
    }


    public function edit($slug)
    {
        $page = 'editPost';
        $edit = Post::where('slug', $slug)->first();
        $post = Post::where('slug', $slug)->first();
        $category = Category::get();
        $show = User::findOrFail(Auth::id());
        return view('frontend.Post.front_post_edit', compact('edit', 'post', 'category', 'page', 'show'));
    }

    public function update(Request $request, $slug)
    {
        $update = Post::where('slug', $slug)->first();
        $user = User::where('id', $update->user_id)->first();
        $pilkat = $update->category_id;

        $request->validate([
            'file' => [
                'file',
                'max:10240',
                function ($attribute, $value, $fail) use ($pilkat) {
                    $ext = $value->getClientOriginalExtension();
                    $categoryFileTypes = [
                        3 => ['png', 'jpg', 'jpeg', 'eps', 'psd', 'ai'], // Tipe file untuk kategori photo
                        4 => ['mp4', 'mkv', 'webm'], // Tipe file untuk kategori video
                        5 => ['mp3', 'm4a'], // Tipe file untuk kategori audio
                    ];

                    // Periksa apakah kategori yang dipilih memiliki definisi tipe file
                    if (isset($categoryFileTypes[$pilkat])) {
                        // Jika tipe file yang diunggah tidak ada dalam definisi kategori, tampilkan pesan kesalahan
                        if (!in_array($ext, $categoryFileTypes[$pilkat])) {
                            $fail('Tipe file yang diunggah tidak sesuai dengan kategori yang dipilih.');
                        }
                    } else {
                        // Jika kategori yang dipilih tidak memiliki definisi tipe file, tampilkan pesan kesalahan
                        $fail('Kategori yang dipilih tidak memiliki tipe file ini.');
                    }
                },
            ],
            'file2' => [
                'file',
                'max:10240',
                function ($attribute, $value, $fail) use ($pilkat) {
                    $ext = $value->getClientOriginalExtension();
                    $categoryFileTypes = [
                        3 => ['eps', 'psd', 'ai', 'zip', 'rar'], // Tipe file untuk file2 dengan kategori photo
                        4 => ['aep', 'aepx', 'prproj', 'zip', 'rar'], // Tipe file untuk file2 dengan kategori video
                        5 => ['aup3', 'sesx', 'als', 'zip', 'rar'], // Tipe file untuk file2 dengan kategori audio
                    ];

                    // Periksa apakah kategori yang dipilih memiliki definisi tipe file
                    if (isset($categoryFileTypes[$pilkat])) {
                        // Jika tipe file yang diunggah tidak ada dalam definisi kategori, tampilkan pesan kesalahan
                        if (!in_array($ext, $categoryFileTypes[$pilkat])) {
                            $fail('Tipe file yang diunggah tidak sesuai dengan kategori yang dipilih.');
                        }
                    } else {
                        // Jika kategori yang dipilih tidak memiliki definisi tipe file, tampilkan pesan kesalahan
                        $fail('Kategori yang dipilih tidak memiliki tipe file ini.');
                    }
                },
            ],
        ], [
            'file.required' => 'Harus ada file yang dimasukkan.',
            'file.mimes' => 'File harus berupa gambar, video, atau audio.',
            'file2.mimes' => 'Tipe file yang diunggah tidak sesuai dengan file kedua.',
        ]);


        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $ext = $files->getClientOriginalExtension();
            if (empty($update->file)) {
                if (file_exists(storage_path('app/public/uploads/photo/' . $update->file == ''))) {
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                        $ext = $request->file('file')->extension();
                        $final = 'photo' . time() . '.' . $ext;

                        // Kompresi gambar
                        $compressedImage = Image::make($files)->encode($ext, 10);
                        $resolution = $compressedImage->height() . "x" . $compressedImage->width();

                        $compressedImage->save(storage_path('app/public/uploads/photo/compress/') . $final);

                        // menyimpan gambar asli
                        $request->file('file')->move(storage_path('app/public/uploads/photo/'), $final);
                        $update->resolution = $resolution;
                        $update->file = $final;
                    }
                } elseif ($update->file == '') {
                    if ($ext == 'mp4' || $ext == 'mkv' || $ext == 'webm') {
                        $pathVideo = 'video';
                        $pathThumbnail = 'video/thumbnail';
                        $file = $request->file('file')->getClientOriginalName();
                        $fileName = pathinfo($file, PATHINFO_FILENAME);
                        $publicId = date('Y-m-d_His') . '_' . $fileName;
                        $cPublicId = $pathVideo . '/' . $publicId;

                        $uploadVideo = Cloudinary::uploadVideo(
                            $request->file('file')->getRealPath(),
                            [
                                "public_id" => $publicId,
                                "folder" => $pathVideo,
                            ]
                        )->getSecurePath();

                        // Upload thumbnail (gambar GIF) ke Cloudinary
                        // $uploadThumbnail = Cloudinary::uploadFile($request->file('file')->getRealPath(), [
                        //     "public_id" => $publicId . '-thumbnail',
                        //     "folder" => $pathThumbnail,
                        //     "transformation" => [
                        //         "width" => 200,
                        //         "start_offset" => "auto",
                        //         "resource_type" => "video"
                        //     ]
                        // ]);

                        // Konversi video ke kualitas 720p, 480p, dan 360p
                        $path720p = 'video/720p';
                        $path480p = 'video/480p';
                        $path360p = 'video/360p';

                        // Transformasi untuk 720p
                        $upload720p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                            "public_id" => $publicId . '-720p',
                            "folder" => $path720p,
                            "transformation" => [
                                'width' => 1280,
                                'height' => 720,
                            ]
                        ])->getSecurePath();

                        // Transformasi untuk 480p
                        $upload480p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                            "public_id" => $publicId . '-480p',
                            "folder" => $path480p,
                            "transformation" => [
                                'width' => 854,
                                'height' => 480
                            ]
                        ])->getSecurePath();

                        // Transformasi untuk 360p
                        $upload360p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                            "public_id" => $publicId . '-360p',
                            "folder" => $path360p,
                            "transformation" => [
                                'width' => 640,
                                'height' => 360
                            ]
                        ])->getSecurePath();

                        $cPublicId720 = $path720p . '/' . $publicId . '-720p';
                        $cPublicId480 = $path480p . '/' . $publicId . '-480p';
                        $cPublicId360 = $path360p . '/' . $publicId . '-360p';

                        $update->oriVideo = $uploadVideo;
                        $update->q720p = $upload720p;
                        $update->q480p = $upload480p;
                        $update->q360p = $upload360p;
                        $update->cPublicId = $cPublicId;
                        $update->cPublicId720 = $cPublicId720;
                        $update->cPublicId480 = $cPublicId480;
                        $update->cPublicId360 = $cPublicId360;
                    }
                } elseif (file_exists(storage_path('app/public/uploads/audio/' . $update->file == ''))) {
                    if ($ext == 'mp3' || $ext == 'm4a') {
                        $ext = $request->file('file')->extension();
                        $final = 'audio' . time() . '.' . $ext;
                        $request->file('file')->move(storage_path('app/public/uploads/audio/'), $final);
                        $update->file = $final;
                    }
                }
            } elseif ($update->file) {
                if (file_exists(storage_path('app/public/uploads/photo/' . $update->file))) {
                    unlink(storage_path('app/public/uploads/photo/' . $update->file));
                    unlink(storage_path('app/public/uploads/photo/compress/' . $update->file));
                    if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
                        $ext = $request->file('file')->extension();
                        $final = 'photo' . time() . '.' . $ext;

                        // Kompresi gambar
                        $compressedImage = Image::make($files)->encode($ext, 10);
                        $resolution = $compressedImage->height() . "x" . $compressedImage->width();

                        $compressedImage->save(storage_path('app/public/uploads/photo/compress/') . $final);

                        // menyimpan gambar asli
                        $request->file('file')->move(storage_path('app/public/uploads/photo/'), $final);
                        $update->resolution = $resolution;
                        $update->file = $final;
                    }
                } elseif ($update->file) {
                    $publicId = $update->cPublicId;
                    $publicId720 = $update->cPublicId720;
                    $publicId480 = $update->cPublicId480;
                    $publicId360 = $update->cPublicId360;
                    Cloudinary::destroy($publicId, ['resource_type' => 'video']);
                    Cloudinary::destroy($publicId720, ['resource_type' => 'video']);
                    Cloudinary::destroy($publicId480, ['resource_type' => 'video']);
                    Cloudinary::destroy($publicId360, ['resource_type' => 'video']);

                    if ($ext == 'mp4' || $ext == 'mkv' || $ext == 'webm' || $ext == 'jpg') {
                        $pathVideo = 'video';
                        $pathThumbnail = 'video/thumbnail';
                        $file = $request->file('file')->getClientOriginalName();
                        $fileName = pathinfo($file, PATHINFO_FILENAME);
                        $publicId = date('Y-m-d_His') . '_' . $fileName;
                        $cPublicId = $pathVideo . '/' . $publicId;

                        $uploadVideo = Cloudinary::uploadVideo(
                            $request->file('file')->getRealPath(),
                            [
                                "public_id" => $publicId,
                                "folder" => $pathVideo,
                            ]
                        )->getSecurePath();

                        // Upload thumbnail (gambar GIF) ke Cloudinary
                        // $uploadThumbnail = Cloudinary::uploadFile($request->file('file')->getRealPath(), [
                        //     "public_id" => $publicId . '-thumbnail',
                        //     "folder" => $pathThumbnail,
                        //     "transformation" => [
                        //         "width" => 200,
                        //         "start_offset" => "auto",
                        //         "resource_type" => "video"
                        //     ]
                        // ]);

                        // Konversi video ke kualitas 720p, 480p, dan 360p
                        $path720p = 'video/720p';
                        $path480p = 'video/480p';
                        $path360p = 'video/360p';

                        // Transformasi untuk 720p
                        $upload720p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                            "public_id" => $publicId . '-720p',
                            "folder" => $path720p,
                            "transformation" => [
                                'width' => 1280,
                                'height' => 720,
                            ]
                        ])->getSecurePath();

                        // Transformasi untuk 480p
                        $upload480p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                            "public_id" => $publicId . '-480p',
                            "folder" => $path480p,
                            "transformation" => [
                                'width' => 854,
                                'height' => 480
                            ]
                        ])->getSecurePath();

                        // Transformasi untuk 360p
                        $upload360p = Cloudinary::uploadVideo($request->file('file')->getRealPath(), [
                            "public_id" => $publicId . '-360p',
                            "folder" => $path360p,
                            "transformation" => [
                                'width' => 640,
                                'height' => 360
                            ]
                        ])->getSecurePath();

                        $cPublicId720 = $path720p . '/' . $publicId . '-720p';
                        $cPublicId480 = $path480p . '/' . $publicId . '-480p';
                        $cPublicId360 = $path360p . '/' . $publicId . '-360p';

                        $update->file = $uploadVideo;
                        $update->q720p = $upload720p;
                        $update->q480p = $upload480p;
                        $update->q360p = $upload360p;
                        $update->cPublicId = $cPublicId;
                        $update->cPublicId720 = $cPublicId720;
                        $update->cPublicId480 = $cPublicId480;
                        $update->cPublicId360 = $cPublicId360;
                    }
                } elseif (file_exists(storage_path('app/public/uploads/audio/' . $update->file))) {
                    unlink(storage_path('app/public/uploads/audio/' . $update->file));
                    if ($ext == 'mp3' || $ext == 'm4a') {
                        $ext = $request->file('file')->extension();
                        $final = 'audio' . time() . '.' . $ext;
                        $request->file('file')->move(storage_path('app/public/uploads/audio/'), $final);
                        $update->file = $final;
                    }
                }
            }
        } elseif ($request->hasFile('file2')) {
            $files2 = $request->file('file2');
            $ext2 = $files2->getClientOriginalExtension();
            if (empty($update->file_mentah)) {
                if ($pilkat == 3 && file_exists(storage_path('app/public/uploads/rawphoto/' . $update->file_mentah == ''))) {
                    if ($ext2 == 'eps' || $ext2 == 'psd' || $ext2 == 'ai' || $ext2 == 'cdr' || $ext2 == 'zip' || $ext2 == 'rar') {
                        $final2 = 'rawphoto' . time() . '.' . $ext2;
                        $request->file('file2')->move(storage_path('app/public/uploads/rawphoto'), $final2);
                        $update->file_mentah = $final2;
                    }
                } elseif ($pilkat == 4 && storage_path('app/public/uploads/rawvideo/')) {
                    if ($ext2 == 'aep' || $ext2 == 'aepx' || $ext2 == 'prproj' || $ext2 == 'zip' || $ext2 == 'rar') {
                        $final2 = 'rawvideo' . time() . '.' . $ext2;
                        $request->file('file2')->move(storage_path('app/public/uploads/rawvideo'), $final2);
                        $update->file_mentah = $final2;
                    }
                } elseif ($pilkat == 5 && storage_path('app/public/uploads/rawaudio/')) {
                    if ($ext2 == 'aup3' || $ext2 == 'sesx' || $ext2 == 'als' || $ext2 == 'zip' || $ext2 == 'rar') {
                        $final2 = 'rawaudio' . time() . '.' . $ext2;
                        $request->file('file2')->move(storage_path('app/public/uploads/rawaudio'), $final2);
                        $update->file_mentah = $final2;
                    }
                }
            } elseif ($update->file_mentah) {
                if ($pilkat == 3 && file_exists(storage_path('app/public/uploads/rawphoto/' . $update->file_mentah))) {
                    unlink(storage_path('app/public/uploads/rawphoto/' . $update->file_mentah));
                    if ($ext2 == 'eps' || $ext2 == 'psd' || $ext2 == 'ai' || $ext2 == 'cdr' || $ext2 == 'zip' || $ext2 == 'rar') {
                        $final2 = 'rawphoto' . time() . '.' . $ext2;
                        $request->file('file2')->move(storage_path('app/public/uploads/rawphoto'), $final2);
                        $update->file_mentah = $final2;
                    }
                } elseif ($pilkat == 4 && file_exists(storage_path('app/public/uploads/rawvideo/' . $update->file_mentah))) {
                    unlink(storage_path('app/public/uploads/rawvideo/' . $update->file_mentah));
                    if ($ext2 == 'aep' || $ext2 == 'aepx' || $ext2 == 'prproj' || $ext2 == 'zip' || $ext2 == 'rar') {
                        $final2 = 'rawvideo' . time() . '.' . $ext2;
                        $request->file('file2')->move(storage_path('app/public/uploads/rawvideo'), $final2);
                        $update->file_mentah = $final2;
                    }
                } elseif ($pilkat == 5 && file_exists(storage_path('app/public/uploads/rawaudio/' . $update->file_mentah))) {
                    unlink(storage_path('app/public/uploads/rawaudio/' . $update->file_mentah));
                    if ($ext2 == 'aup3' || $ext2 == 'sesx' || $ext2 == 'als' || $ext2 == 'zip' || $ext2 == 'rar') {
                        $final2 = 'rawaudio' . time() . '.' . $ext2;
                        $request->file('file2')->move(storage_path('app/public/uploads/rawaudio'), $final2);
                        $update->file_mentah = $final2;
                    }
                }
            }
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'url=' => [new EmbeddableUrl],

        ], [
            'body.required' => 'deskripsi harus diisikan',
            'title.required' => 'title tidak boleh kosong',
        ]);
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $update->slug = $slug;
        $update->name = $request->title;
        // $update->category_id = $newCategory;
        $update->url = $request->linkyt;

        if (strpos($request->linkgd, 'preview') !== false) {
            $change_link = $request->linkgd;
            $update->urlgd = $change_link;
        } elseif (strpos($request->linkgd, 'view') !== false) {
            $change_link = str_replace('view', 'preview', $request->linkgd);
            $update->urlgd = $change_link;
        }

        if ($request->has('file2Link')) {
            if (strpos($request->file2Link, 'preview') !== false) {
                $change_link2 = $request->file2Link;
                $update->fpgd = $change_link2;
            } elseif (strpos($request->file2Link, 'view') !== false) {
                $change_link2 = str_replace('view', 'preview', $request->file2Link);
                $update->fpgd = $change_link2;
            }
        }

        $update->body = $request->body;
        $update->update();
        return redirect()->route('post_show', [$user->name])->with('success', 'berhasil di edit');
    }
}
