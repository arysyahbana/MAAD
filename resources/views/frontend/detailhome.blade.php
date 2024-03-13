@extends('frontend.layouts2.main2')

@section('title', 'MAD | Detail Post')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            @php
                $path_photo = asset('storage/uploads/photo/' . $post->file);
                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                $path_video = $post->file;
                $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                $path_video_720p = $post->q720p;
                $extvideo720p = pathinfo($path_video_720p, PATHINFO_EXTENSION);

                $path_video_480p = $post->q480p;
                $extvideo480p = pathinfo($path_video_480p, PATHINFO_EXTENSION);

                $path_video_360p = $post->q360p;
                $extvideo360p = pathinfo($path_video_360p, PATHINFO_EXTENSION);

                $path_audio = asset('storage/uploads/audio/' . $post->file);
                $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                $path_raw_photo = asset('storage/uploads/rawphoto/' . $post->file_mentah);
                $extrawphoto = pathinfo($path_raw_photo, PATHINFO_EXTENSION);

                $path_raw_video = asset('storage/uploads/rawvideo/' . $post->file_mentah);
                $extrawvideo = pathinfo($path_raw_video, PATHINFO_EXTENSION);

                $path_raw_audio = asset('storage/uploads/rawaudio/' . $post->file_mentah);
                $extrawaudio = pathinfo($path_raw_audio, PATHINFO_EXTENSION);

            @endphp

            {{-- Photo --}}
            @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                <div class="col col-12 col-lg-8 order-2 order-lg-1">
                    <div class="card shadow mt-5 rounded-4">
                        <img src="{{ asset($path_photo) }}" class="img-fluid rounded-4 object-fit-cover" alt="..."
                            style="max-height: 40rem">
                    </div>
                    {{-- Photo lainnya --}}
                    <div class="row">
                        <div class="" style="height: 10vh"></div>
                        <div class="fw-bold">Aset Lainnya</div>
                        @foreach ($posts as $item)
                            @php
                                $path_photo = asset('storage/uploads/photo/compress/' . $item->file);
                                $extphotoItem = pathinfo($path_photo, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extphotoItem == 'jpg' || $extphotoItem == 'png' || $extphotoItem == 'jpeg')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <img src="{{ $path_photo }}" alt="Card Image" class="img-fluid" />
                                        <div class="category-logo">
                                            <i class="bi bi-image-fill"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item->urlgd && $item->rCategory->name == 'Photo')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up" data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay"
                                            class="gd"></iframe>
                                        <div class="category-logo">
                                            <i class="bi bi-image-fill"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- end Photo lainnya --}}
                </div>

                <div class="col col-12 col-lg-4 pt-lg-5 order-1 order-lg-2">
                    <div class="container py-4">
                        <div class="row">
                            <div class="col col-12 mt-2">
                                <div class="pt-5">
                                    <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                                    <br />
                                    <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                            class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                                    | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                                        class="small text-success">{{ $extphoto }},
                                        {{ $extrawphoto }}</span>
                                    <p class="pt-4">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('like', $post->id) }}" class="text-decoration-none text-danger"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                {{-- Login Premium --}}
                                @if (Auth::guard('web')->user()->role == 'premium' || Auth::guard('web')->user()->id == $post->user_id)
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawphoto }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawphoto }}</span>
                                            </a>
                                        </div>
                                    @elseif($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Premium --}}
                                    {{-- Login Umum --}}
                                @elseif (Auth::guard('web')->user()->role == 'umum')
                                    @if ($post->file_mentah && $post->fpgd)
                                        {{-- Button trigger modal --}}
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawphoto }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control" data-bs-toggle="modal"
                                                data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawphoto }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Umum --}}
                                    {{-- Login Pending --}}
                                @elseif (Auth::guard('web')->user()->role == 'pending')
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawphoto }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawphoto }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                {{-- end Login Pending --}}

                                <br>
                                <div class="col col-12 col-lg-7 mt-3">
                                    <a href="{{ route('download', $post->file) }}"
                                        class="btn btn-sm btn-success download-btn form-control" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <span class="small"><i class="bi bi-download"></i> Download
                                            {{ $extphoto }}</span>
                                    </a>
                                </div>

                                {{-- Tidak Login --}}
                            @else
                                <a href="#" class="text-decoration-none text-danger" onclick="loginfail()"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                @if ($post->file_mentah && $post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawphoto }}</span>
                                        </a>
                                    </div>
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @elseif ($post->file_mentah)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawphoto }}</span>
                                        </a>
                                    </div>
                                @elseif ($post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @endif

                                <div class="col col-12 col-lg-7 mt-3">
                                    <a href="#" class="btn btn-sm btn-success form-control" onclick="loginfail()">
                                        <span class="small"><i class="bi bi-download"></i> Download
                                            {{ $extphoto }}</span>
                                    </a>
                                </div>
                                {{-- end Tidak Login --}}
                            @endauth

                        </div>
                    </div>
                </div>
            @endif
            {{-- end Photo --}}

            {{-- Video --}}
            @if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm')
                <div class="col col-12 col-lg-8 pt-5 order-2 order-lg-1">
                    @if ($page == 'detail')
                        <div class="card shadow">
                            <video class="object-fit-contain" controls style="max-height:40rem;">
                                @if ($extvideo == 'mp4')
                                    <source src="{{ $path_video }}" alt="" type="video/mp4">
                                @endif
                                @if ($extvideo == 'mkv')
                                    <source src="{{ $path_video }}" alt="" type="video/mkv">
                                @endif
                                @if ($extvideo == 'webm')
                                    <source src="{{ $path_video }}" alt="" type="video/webm">
                                @endif
                            </video>
                        </div>
                    @elseif ($page == '720p')
                        <div class="card shadow">
                            <video class="object-fit-contain" controls style="max-height:40rem;">
                                @if ($extvideo720p == 'mp4')
                                    <source src="{{ $path_video_720p }}" alt="" type="video/mp4">
                                @endif
                                @if ($extvideo720p == 'mkv')
                                    <source src="{{ $path_video_720p }}" alt="" type="video/mkv">
                                @endif
                                @if ($extvideo720p == 'webm')
                                    <source src="{{ $path_video_720p }}" alt="" type="video/webm">
                                @endif
                            </video>
                        </div>
                    @elseif ($page == '480p')
                        <div class="card shadow">
                            <video class="object-fit-contain" controls style="max-height:40rem;">
                                @if ($extvideo480p == 'mp4')
                                    <source src="{{ $path_video_480p }}" alt="" type="video/mp4">
                                @endif
                                @if ($extvideo480p == 'mkv')
                                    <source src="{{ $path_video_480p }}" alt="" type="video/mkv">
                                @endif
                                @if ($extvideo480p == 'webm')
                                    <source src="{{ $path_video_480p }}" alt="" type="video/webm">
                                @endif
                            </video>
                        </div>
                    @elseif ($page == '360p')
                        <div class="card shadow">
                            <video class="object-fit-contain" controls style="max-height:40rem;">
                                @if ($extvideo360p == 'mp4')
                                    <source src="{{ $path_video_360p }}" alt="" type="video/mp4">
                                @endif
                                @if ($extvideo360p == 'mkv')
                                    <source src="{{ $path_video_360p }}" alt="" type="video/mkv">
                                @endif
                                @if ($extvideo360p == 'webm')
                                    <source src="{{ $path_video_360p }}" alt="" type="video/webm">
                                @endif
                            </video>
                        </div>
                    @endif
                    <div class="text-center my-3">
                        <a href="{{ route('detail', [$post->slug]) }}"
                            class="btn btn-sm {{ $page == 'detail' ? ' btn-orange btn-danger' : 'btn-secondary' }}">Original</a>
                        <a href="{{ route('720p', [$post->slug]) }}"
                            class="btn btn-sm {{ $page == '720p' ? ' btn-orange btn-danger' : 'btn-secondary' }}">720p</a>
                        <a href="{{ route('480p', [$post->slug]) }}"
                            class="btn btn-sm {{ $page == '480p' ? ' btn-orange btn-danger' : 'btn-secondary' }}">480p</a>
                        <a href="{{ route('360p', [$post->slug]) }}"
                            class="btn btn-sm {{ $page == '360p' ? ' btn-orange btn-danger' : 'btn-secondary' }}">360p</a>
                    </div>

                    {{-- Video lainnya --}}
                    <div class="row">
                        <div class="" style="height: 10vh"></div>
                        <div class="fw-bold">Aset Lainnya</div>
                        @foreach ($posts as $item)
                            @php
                                $path_video = $item->file;
                                $extvideoItem = pathinfo($path_video, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extvideoItem == 'mp4' || $extvideoItem == 'mkv' || $extvideoItem == 'webm')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <video class="" controls>
                                            @if ($extvideoItem == 'mp4')
                                                <source src="{{ $path_video }}" alt="" type="video/mp4">
                                            @endif
                                            @if ($extvideoItem == 'mkv')
                                                <source src="{{ $path_video }}" alt="" type="video/mkv">
                                            @endif
                                            @if ($extvideoItem == 'webm')
                                                <source src="{{ $path_video }}" alt="" type="video/webm">
                                            @endif
                                        </video>
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item->url)
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item->urlgd && $item->rCategory->name == 'Video')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                            allow="autoplay" class="gd"></iframe>
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- end Video lainnya --}}
                </div>

                <div class="col col-12 col-lg-4 pt-lg-5 order-1 order-lg-2">

                    <div class="container py-4">
                        <div class="row">
                            <div class="col col-12 mt-2">
                                <div class="pt-5">
                                    <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                                    <br />
                                    <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                            class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                                    | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                                        class="small text-success">{{ $extvideo }},
                                        {{ $extrawvideo }}</span>
                                    <p class="pt-4">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('like', $post->id) }}" class="text-decoration-none text-danger"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                {{-- Login Premium --}}
                                @if (Auth::guard('web')->user()->role == 'premium' || Auth::guard('web')->user()->id == $post->user_id)
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Premium --}}
                                    {{-- Login Umum --}}
                                @elseif (Auth::guard('web')->user()->role == 'umum')
                                    @if ($post->file_mentah && $post->fpgd)
                                        {{-- Button trigger modal --}}
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                    @elseif($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Umum --}}
                                    {{-- Login Pending --}}
                                @elseif (Auth::guard('web')->user()->role == 'pending')
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                {{-- end Login Pending --}}

                                <br>
                                <div class="col col-12 col-lg-7 mt-3">
                                    <div class="btn-group dropend">
                                        <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="small">Download {{ $extvideo }}</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('download-video', ['filename' => $post->slug, 'quality' => 'original']) }}"
                                                    class="dropdown-item small">Original</a></li>
                                            <li><a href="{{ route('download-video', ['filename' => $post->slug, 'quality' => 'q720p']) }}"
                                                    class="dropdown-item small">720p</a></li>
                                            <li><a href="{{ route('download-video', ['filename' => $post->slug, 'quality' => 'q480p']) }}"
                                                    class="dropdown-item small">480p</a></li>
                                            <li><a href="{{ route('download-video', ['filename' => $post->slug, 'quality' => 'q360p']) }}"
                                                    class="dropdown-item small">360p</a></li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- Tidak Login --}}
                            @else
                                <a href="#" class="text-decoration-none text-danger" onclick="loginfail()"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                @if ($post->file_mentah && $post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawvideo }}</span>
                                        </a>
                                    </div>
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @elseif ($post->file_mentah)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawvideo }}</span>
                                        </a>
                                    </div>
                                @elseif ($post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @endif

                                <div class="col col-12 col-lg-7 mt-3">
                                    <a href="#" class="btn btn-sm btn-success form-control" onclick="loginfail()">
                                        <span class="small"><i class="bi bi-download"></i> Download
                                            {{ $extvideo }}</span>
                                    </a>
                                </div>
                                {{-- end Tidak Login --}}
                            @endauth

                        </div>
                    </div>
                </div>
            @endif
            {{-- end Video --}}

            {{-- Audio --}}
            @if ($extaudio == 'mp3' || $extaudio == 'm4a')
                <div class="col col-12 col-lg-8 pt-5 order-2 order-lg-1">
                    <div class="card shadow bg-dark rounded-5">
                        <div class="card-header container text-center">
                            <div class="music">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <audio controls>
                                @if ($extaudio == 'mp3')
                                    <source src="{{ $path_audio }}" alt="" type="audio/mp3">
                                @endif
                                @if ($extaudio == 'm4a')
                                    <source src="{{ $path_audio }}" alt="" type="audio/m4a">
                                @endif
                            </audio>
                        </div>
                    </div>
                    {{-- Audio lainnya --}}
                    <div class="row">
                        <div class="" style="height: 10vh"></div>
                        <div class="fw-bold">Aset Lainnya</div>
                        @foreach ($posts as $item)
                            @php
                                $path_audio = asset('storage/uploads/audio/' . $item->file);
                                $extaudioItem = pathinfo($path_audio, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extaudioItem == 'mp3' || $extaudioItem == 'm4a')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <div class="music p-5 bg-dark">
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                            <span class="bar"></span>
                                        </div>
                                        <div class="category-logo">
                                            <i class="bi bi-music-note-beamed"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            @if ($extaudioItem == 'mp3')
                                                <audio src="{{ $path_audio }}" type="audio/mp3" controls
                                                    class="waudio border border-success rounded-5"></audio>
                                            @endif
                                            @if ($extaudioItem == 'm4a')
                                                <audio src="{{ $path_audio }}" type="audio/m4a" controls
                                                    class="waudio border border-success rounded-5"></audio>
                                            @endif
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item->urlgd && $item->rCategory->name == 'Audio')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                            allow="autoplay" class="gd"></iframe>
                                        <div class="category-logo">
                                            <i class="bi bi-music-note-beamed"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- end Audio lainnya --}}
                </div>

                <div class="col col-12 col-lg-4 pt-lg-4 order-1 order-lg-2">
                    <div class="container">
                        <div class="row">
                            <div class="col col-12 mt-2">
                                <div class="pt-5">
                                    <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                                    <br />
                                    <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                            class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                                    | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                                        class="small text-success">{{ $extaudio }},
                                        {{ $extrawaudio }}</span>
                                    <p class="pt-4">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('like', $post->id) }}" class="text-decoration-none text-danger"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                {{-- Login Premium --}}
                                @if (Auth::guard('web')->user()->role == 'premium' || Auth::guard('web')->user()->id == $post->user_id)
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawaudio }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawaudio }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Premium --}}
                                    {{-- Login Umum --}}
                                @elseif (Auth::guard('web')->user()->role == 'umum')
                                    @if ($post->file_mentah && $post->fpgd)
                                        {{-- Button trigger modal --}}
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawaudio }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawaudio }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Umum --}}
                                    {{-- Login Pending --}}
                                @elseif (Auth::guard('web')->user()->role == 'pending')
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawaudio }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawaudio }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                {{-- end Login Pending --}}

                                <br>
                                <div class="col col-12 col-lg-7 mt-3">
                                    <a href="{{ route('download', $post->file) }}"
                                        class="btn btn-sm btn-success download-btn form-control" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <span class="small"><i class="bi bi-download"></i>
                                            Download {{ $extaudio }}</span>
                                    </a>
                                </div>

                                {{-- Tidak Login --}}
                            @else
                                <a href="#" class="text-decoration-none text-danger" onclick="loginfail()"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                @if ($post->file_mentah && $post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawaudio }}</span>
                                        </a>
                                    </div>
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @elseif ($post->file_mentah)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawaudio }}</span>
                                        </a>
                                    </div>
                                @elseif ($post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @endif

                                <div class="col col-12 col-lg-7 mt-3">
                                    <a href="#" class="btn btn-sm btn-success form-control" onclick="loginfail()">
                                        <span class="small"><i class="bi bi-download"></i> Download
                                            {{ $extaudio }}</span>
                                    </a>
                                </div>
                                {{-- end Tidak Login --}}
                            @endauth

                        </div>
                    </div>
                </div>
            @endif
            {{-- end Audio --}}

            {{-- Youtube --}}
            @if ($post->url)
                <div class="col col-12 col-lg-8 pt-5 order-2 order-lg-1">
                    <div class="card shadow rounded-5">
                        <x-embed url="{{ $post->url }}" aspect-ratio="10:5" style="width: 400px; height: 300px;" />
                    </div>

                    {{-- Video lainnya --}}
                    <div class="row">
                        <div class="" style="height: 10vh"></div>
                        <div class="fw-bold">Aset Lainnya</div>
                        @foreach ($posts as $item)
                            @php
                                $path_video = $item->file;
                                $extvideoItem2 = pathinfo($path_video, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extvideoItem2 == 'mp4' || $extvideoItem2 == 'mkv' || $extvideoItem2 == 'webm')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <video class="" controls>
                                            @if ($extvideoItem2 == 'mp4')
                                                <source src="{{ $path_video }}" alt="" type="video/mp4">
                                            @endif
                                            @if ($extvideoItem2 == 'mkv')
                                                <source src="{{ $path_video }}" alt="" type="video/mkv">
                                            @endif
                                            @if ($extvideoItem2 == 'webm')
                                                <source src="{{ $path_video }}" alt="" type="video/webm">
                                            @endif
                                        </video>
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item->url)
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($item->urlgd && $item->rCategory->name == 'Video')
                                <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                    data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                            allow="autoplay" class="gd"></iframe>
                                        <div class="category-logo">
                                            <i class="bi bi-film"></i>
                                        </div>
                                        <div class="deskripsi">
                                            <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                            <p class="fs-6 teks">{{ $item->body }}</p>
                                            <a href="{{ route('detail', [$item->slug]) }}"
                                                class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    {{-- end Video lainnya --}}
                </div>

                <div class="col col-12 col-lg-4 pt-5 order-1 order-lg-2">
                    <div class="container">
                        <div class="row">
                            <div class="col col-12 mt-2">
                                <div class="pt-5">
                                    <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                                    <br />
                                    <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                            class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                                    | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                                        class="small text-success">Youtube,
                                        {{ $extrawvideo }}</span>
                                    <p class="pt-4">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('like', $post->id) }}" class="text-decoration-none text-danger"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                {{-- Login Premium --}}
                                @if (Auth::guard('web')->user()->role == 'premium' || Auth::guard('web')->user()->id == $post->user_id)
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ route('download', $post->file_mentah) }}"
                                                class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Premium --}}
                                    {{-- Login Umum --}}
                                @elseif (Auth::guard('web')->user()->role == 'umum')
                                    @if ($post->file_mentah && $post->fpgd)
                                        {{-- Button trigger modal --}}
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Umum --}}
                                    {{-- Login Pending --}}
                                @elseif (Auth::guard('web')->user()->role == 'pending')
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Download {{ $extrawvideo }}</span>
                                            </a>
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                {{-- end Login Pending --}}


                                {{-- Tidak Login --}}
                            @else
                                <a href="#" class="text-decoration-none text-danger" onclick="loginfail()"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                @if ($post->file_mentah && $post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawvideo }}</span>
                                        </a>
                                    </div>
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @elseif ($post->file_mentah)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Download {{ $extrawvideo }}</span>
                                        </a>
                                    </div>
                                @elseif ($post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control" onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @endif

                                {{-- end Tidak Login --}}
                            @endauth

                        </div>
                    </div>
                </div>
            @endif
            {{-- end Youtube --}}

            {{-- Googledrive --}}
            @if ($post->urlgd)
                <div class="col col-12 col-lg-8 pt-5 order-2 order-lg-1">
                    <div class="card shadow overflow-scroll">
                        <iframe src="{{ $post->urlgd }}" width="854" height="480" allow="autoplay"
                            class="object-fit-fill"></iframe>
                    </div>

                    <div class="row">
                        <div class="" style="height: 10vh"></div>
                        <div class="fw-bold">Aset Lainnya</div>
                        @if ($post->rCategory->name == 'Photo')
                            {{-- Photo lainnya --}}
                            @foreach ($posts as $item)
                                @php
                                    $path_photo2 = asset('storage/uploads/photo/compress/' . $item->file);
                                    $extphotoItem2 = pathinfo($path_photo2, PATHINFO_EXTENSION);
                                @endphp
                                @if ($extphotoItem2 == 'jpg' || $extphotoItem2 == 'png' || $extphotoItem2 == 'jpeg')
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <img src="{{ $path_photo2 }}" alt="Card Image" class="img-fluid" />
                                            <div class="category-logo">
                                                <i class="bi bi-image-fill"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($item->urlgd && $item->rCategory->name == 'Photo')
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                                allow="autoplay" class="gd"></iframe>
                                            <div class="category-logo">
                                                <i class="bi bi-image-fill"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            {{-- end Photo lainnya --}}
                        @elseif ($post->rCategory->name == 'Video')
                            {{-- Video lainnya --}}
                            @foreach ($posts as $item)
                                @php
                                    $path_video2 = $item->file;
                                    $extvideoItem2 = pathinfo($path_video2, PATHINFO_EXTENSION);
                                @endphp
                                @if ($extvideoItem2 == 'mp4' || $extvideoItem2 == 'mkv' || $extvideoItem2 == 'webm')
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <video class="" controls>
                                                @if ($extvideoItem2 == 'mp4')
                                                    <source src="{{ $path_video2 }}" alt="" type="video/mp4">
                                                @endif
                                                @if ($extvideoItem2 == 'mkv')
                                                    <source src="{{ $path_video2 }}" alt="" type="video/mkv">
                                                @endif
                                                @if ($extvideoItem2 == 'webm')
                                                    <source src="{{ $path_video2 }}" alt="" type="video/webm">
                                                @endif
                                            </video>
                                            <div class="category-logo">
                                                <i class="bi bi-film"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($item->url)
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <x-embed url="{{ $item->url }}" aspect-ratio="4:3" />
                                            <div class="category-logo">
                                                <i class="bi bi-film"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($item->urlgd && $item->rCategory->name == 'Video')
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                                allow="autoplay" class="gd"></iframe>
                                            <div class="category-logo">
                                                <i class="bi bi-film"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            {{-- end Video lainnya --}}
                        @elseif ($post->rCategory->name == 'Audio')
                            {{-- Audio Lainnya --}}
                            @foreach ($posts as $item)
                                @php
                                    $path_audio2 = asset('storage/uploads/audio/' . $item->file);
                                    $extaudioItem2 = pathinfo($path_audio2, PATHINFO_EXTENSION);
                                @endphp
                                @if ($extaudioItem2 == 'mp3' || $extaudioItem2 == 'm4a')
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <div class="music p-5 bg-dark">
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                            </div>
                                            <div class="category-logo">
                                                <i class="bi bi-music-note-beamed"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                @if ($extaudioItem2 == 'mp3')
                                                    <audio src="{{ $path_audio2 }}" type="audio/mp3" controls
                                                        class="waudio border border-success rounded-5"></audio>
                                                @endif
                                                @if ($extaudioItem2 == 'm4a')
                                                    <audio src="{{ $path_audio2 }}" type="audio/m4a" controls
                                                        class="waudio border border-success rounded-5"></audio>
                                                @endif
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($item->urlgd && $item->rCategory->name == 'Audio')
                                    <div class="col col-12 col-md-6 col-lg-4 mt-3" data-aos="fade-up"
                                        data-aos-duration="1200">
                                        <div class="card-custom shadow rounded-3 mx-auto">
                                            <iframe src="{{ $item->urlgd }}" width="640" height="480"
                                                allow="autoplay" class="gd"></iframe>
                                            <div class="category-logo">
                                                <i class="bi bi-music-note-beamed"></i>
                                            </div>
                                            <div class="deskripsi">
                                                <h5 class="fw-bold teks">{{ $item->name }}</h5>
                                                <p class="fs-6 teks">{{ $item->body }}</p>
                                                <a href="{{ route('detail', [$item->slug]) }}"
                                                    class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            {{-- end Audio Lainnya --}}
                        @endif
                    </div>
                </div>

                <div class="col col-12 col-lg-4 pt-5 order-1 order-lg-2">
                    <div class="container">
                        <div class="row">
                            <div class="col col-12 mt-2">
                                <div class="pt-5">
                                    <span class="display-6 text-dark fw-bold">{{ $post->name }}</span>
                                    <br />
                                    <span class="small">by <a href="{{ route('profile', [$post->rUser->name]) }}"
                                            class="text-decoration-none text-primary">{{ $post->rUser->name }}</a></span>
                                    | <span class="small text-orange">{{ $post->rCategory->name }}</span> | <span
                                        class="small text-success">Googledrive,
                                        @if ($post->rCategory->name == 'Photo')
                                            {{ $extrawphoto }}
                                        @elseif ($post->rCategory->name == 'Video')
                                            {{ $extrawvideo }}
                                        @elseif ($post->rCategory->name == 'Audio')
                                            {{ $extrawaudio }}
                                        @endif
                                    </span>
                                    <p class="pt-4">
                                        {{ $post->body }}
                                    </p>
                                </div>
                            </div>

                            @auth
                                <a href="{{ route('like', $post->id) }}" class="text-decoration-none text-danger"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>

                                {{-- Login Premium --}}
                                @if (Auth::guard('web')->user()->role == 'premium' || Auth::guard('web')->user()->id == $post->user_id)
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            @if ($post->rCategory->name == 'Photo')
                                                <a href="{{ route('download', $post->file_mentah) }}"
                                                    class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawphoto }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Video')
                                                <a href="{{ route('download', $post->file_mentah) }}"
                                                    class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawvideo }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Audio')
                                                <a href="{{ route('download', $post->file_mentah) }}"
                                                    class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawaudio }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            @if ($post->rCategory->name == 'Photo')
                                                <a href="{{ route('download', $post->file_mentah) }}"
                                                    class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawphoto }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Video')
                                                <a href="{{ route('download', $post->file_mentah) }}"
                                                    class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawvideo }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Audio')
                                                <a href="{{ route('download', $post->file_mentah) }}"
                                                    class="btn btn-sm btn-orange btn-danger download-btn form-control"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawaudio }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="{{ $post->fpgd }}" class="btn btn-sm btn-primary form-control"
                                                target="blank">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif

                                    {{-- end Login Premium --}}

                                    {{-- Login Umum --}}
                                @elseif (Auth::guard('web')->user()->role == 'umum')
                                    {{-- Button trigger modal --}}
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            @if ($post->rCategory->name == 'Photo')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawphoto }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Video')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawvideo }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Audio')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawaudio }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            @if ($post->rCategory->name == 'Photo')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawphoto }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Video')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawvideo }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Audio')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    data-bs-toggle="modal" data-bs-target="#subscribe">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawaudio }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                data-bs-toggle="modal" data-bs-target="#subscribe">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                    {{-- end Login Umum --}}
                                    {{-- Login Pending --}}
                                @elseif (Auth::guard('web')->user()->role == 'pending')
                                    @if ($post->file_mentah && $post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            @if ($post->rCategory->name == 'Photo')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    onclick="loginpending()">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawphoto }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Video')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    onclick="loginpending()">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawvideo }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Audio')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    onclick="loginpending()">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawaudio }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @elseif ($post->file_mentah)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            @if ($post->rCategory->name == 'Photo')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    onclick="loginpending()">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawphoto }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Video')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    onclick="loginpending()">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawvideo }}
                                                    </span>
                                                </a>
                                            @elseif ($post->rCategory->name == 'Audio')
                                                <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                    onclick="loginpending()">
                                                    <span class="small">
                                                        <i class="bi bi-download"></i> Download
                                                        {{ $extrawaudio }}
                                                    </span>
                                                </a>
                                            @endif
                                        </div>
                                    @elseif ($post->fpgd)
                                        <div class="col col-12 col-lg-7 mt-3">
                                            <a href="#" class="btn btn-sm btn-primary form-control"
                                                onclick="loginpending()">
                                                <span class="small"><i class="bi bi-download"></i>
                                                    Googledrive</span>
                                            </a>
                                        </div>
                                    @endif
                                @endif
                                {{-- end Login Pending --}}


                                {{-- Tidak Login --}}
                            @else
                                <a href="#" class="text-decoration-none text-danger" onclick="loginfail()"><span
                                        class="small"><i class="bi bi-heart-fill"></i>
                                        {{ $like }} Like</span></a>
                                @if ($post->file_mentah && $post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        @if ($post->rCategory->name == 'Photo')
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginfail()">
                                                <span class="small">
                                                    <i class="bi bi-download"></i> Download
                                                    {{ $extrawphoto }}
                                                </span>
                                            </a>
                                        @elseif ($post->rCategory->name == 'Video')
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginfail()">
                                                <span class="small">
                                                    <i class="bi bi-download"></i> Download
                                                    {{ $extrawvideo }}
                                                </span>
                                            </a>
                                        @elseif ($post->rCategory->name == 'Audio')
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginfail()">
                                                <span class="small">
                                                    <i class="bi bi-download"></i> Download
                                                    {{ $extrawaudio }}
                                                </span>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @elseif ($post->file_mentah)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        @if ($post->rCategory->name == 'Photo')
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginfail()">
                                                <span class="small">
                                                    <i class="bi bi-download"></i> Download
                                                    {{ $extrawphoto }}
                                                </span>
                                            </a>
                                        @elseif ($post->rCategory->name == 'Video')
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginfail()">
                                                <span class="small">
                                                    <i class="bi bi-download"></i> Download
                                                    {{ $extrawvideo }}
                                                </span>
                                            </a>
                                        @elseif ($post->rCategory->name == 'Audio')
                                            <a href="#" class="btn btn-sm btn-orange btn-danger form-control"
                                                onclick="loginfail()">
                                                <span class="small">
                                                    <i class="bi bi-download"></i> Download
                                                    {{ $extrawaudio }}
                                                </span>
                                            </a>
                                        @endif
                                    </div>
                                @elseif ($post->fpgd)
                                    <div class="col col-12 col-lg-7 mt-3">
                                        <a href="#" class="btn btn-sm btn-primary form-control"
                                            onclick="loginfail()">
                                            <span class="small"><i class="bi bi-download"></i>
                                                Googledrive</span>
                                        </a>
                                    </div>
                                @endif

                                {{-- end Tidak Login --}}
                            @endauth

                        </div>
                    </div>
                </div>
                {{-- {{ $posts->links() }} --}}
            @endif
            {{-- end Googledrive --}}
        </div>
    </div>

    {{-- Modal --}}
    @auth
        <div class="modal fade" id="subscribe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="text-orange">
                                <i class="bi bi-exclamation-triangle-fill"></i></span>
                            Penting !!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tidak bisa melakukan download</p>
                        <p>Klik Go Premium agar anda bisa mendownload file ini...</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-orange btn-danger"
                            href="{{ route('show_premium', Auth::user()->name) }}">Go
                            Premium</a>
                    </div>
                </div>
            </div>
        </div>
    @endauth


    <!-- Modal 2-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="text-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i></span>
                        Penting !!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12 text-center">
                            <img src="{{ asset('dist_frontend/img/UNP Asset.png') }}" alt="" width="200px">
                        </div>
                        <div class="col col-12 mt-2">
                            <p class="fs-5 p-3"> Ingatlah untuk mention
                                creator dan sumber
                                saat menggunakan file ini. Salin detail atribute di bawah
                                ini dan sertakan di project atau situs web Anda.</p>
                        </div>
                    </div>
                    {{-- <a href="{{ $url }}">{{ $url }}</a> --}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="{{ $message }}" id="salin">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            onclick="copyText()"><i class="bi bi-files"></i></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3-->
    <div class="modal fade" id="modalCopy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <img src="{{ asset('dist_frontend/img/UNP Asset.png') }}" alt="" width="200px"> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-12 mt-2">
                            <p class="fs-3 text-center">
                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill"></i></span>
                                Berhasil menyalin
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
