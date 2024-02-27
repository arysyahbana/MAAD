@extends('frontend.layouts2.main2')

@section('title', 'MAD | Show Profile')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-12">
                <h4 class="card-title fs-4 fw-bold text-start pt-3 text-black-custom">Profile {{ $show->name }}</h4>
            </div>
            <div class="col col-12">
                <div class="container px-5 py-3">
                    <div class="card-body">
                        {{-- <p class="fs-3">My Portofolio</p> --}}
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a class="nav-link mx-lg-4 {{ $page == 'Photo' ? 'text-danger active' : 'text-dark' }}"
                                    href="{{ route('profile', $show->name) }}"><i class="bi bi-camera-fill"></i> Photo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-decoration-none mx-lg-4  {{ $page == 'Video' ? 'text-danger active' : 'text-dark' }}"
                                    href="{{ route('profile-video', $show->name) }}"><i class="bi bi-camera-reels-fill"></i>
                                    Video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-decoration-none mx-lg-4  {{ $page == 'Audio' ? 'text-danger active' : 'text-dark' }}"
                                    href="{{ route('profile-audio', $show->name) }}"><i
                                        class="bi bi-file-earmark-music-fill"></i> Audio</a>
                            </li>
                        </ul>
                        @if ($page == 'Photo')
                            <div class="row">
                                @foreach ($post as $item)
                                    @php
                                        $path_photo = asset('storage/uploads/photo/compress/' . $item->file);
                                        $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
                                            data-aos-duration="1200">
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
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
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
                            </div>
                        @elseif ($page == 'Video')
                            <div class="row">
                                @foreach ($post as $item)
                                    @php
                                        $path_video = $item->file;
                                        $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm')
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
                                            data-aos-duration="1200">
                                            <div class="card-custom shadow rounded-3 mx-auto">
                                                <video class="" controls>
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
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
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
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
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
                        @elseif ($page == 'Audio')
                            <div class="row">
                                @foreach ($post as $item)
                                    @php
                                        $path_audio = asset('storage/uploads/audio/' . $item->file);
                                        $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);
                                    @endphp
                                    @if ($extaudio == 'mp3' || $extaudio == 'm4a')
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
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
                                                    @if ($extaudio == 'mp3')
                                                        <audio src="{{ $path_audio }}" type="audio/mp3" controls
                                                            class="waudio border border-success rounded-5"></audio>
                                                    @endif
                                                    @if ($extaudio == 'm4a')
                                                        <audio src="{{ $path_audio }}" type="audio/m4a" controls
                                                            class="waudio border border-success rounded-5"></audio>
                                                    @endif
                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                        class="card-button btn btn-sm warna_search btn-danger">Detail</a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($item->urlgd && $item->rCategory->name == 'Audio')
                                        <div class="col col-12 col-md-6 col-lg-3 mt-1" data-aos="fade-up"
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
                        @endif


                    </div>
                    <div class="mt-5 mb-3">
                        {{ $post->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col col-12 col-md-8">
            <div class="card shadow-lg rounded-5">
                <div class="container px-5 py-3">
                    <div class="card-body">
                        <h3 class="card-title mb-5 display-6 text-center">Profile</h3>
                        <div class="row">
                            <div class="col col-12 col-lg-4 text-center">
                                @php
                                    $path_photo = asset('storage/uploads/photo/profil/' . $show->foto_profil);
                                    $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                                @endphp
                                @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                                    <div class="foto-profil rounded-pill">
                                        <img src="{{ asset($path_photo) }}" alt=""
                                            class="img-fluid rounded-pill">
                                    </div>
                                @elseif ($extphoto == '')
                                    <i class="bi bi-person-circle display-3"></i>
                                @endif
                                <p class="fs-6 mt-3">{{ $show->name }}</p>
                                <p class="fs-6">{{ $show->nim }}</p>
                            </div>
                            <div class="col col-12 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <p>About me...</p>
                                        <p>{{ $show->about }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4 text-center">
                            <div class="col col-12 col-lg-4">
                                <p><i class="bi bi-person-workspace"></i> Status : {{ $show->status }}</p>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <p><i class="bi bi-house-gear-fill"></i> {{ $show->place }}</p>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <p><i class="bi bi-clock"></i> Kontrak :
                                    {{ \Carbon\Carbon::parse($show->contract)->format('d F Y') }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4 text-center">
                            <div class="col col-12 col-lg-4">
                                <p><img src="{{ asset('dist_frontend/img/whatsapp.png') }}" alt=""
                                        class="img-fluid iconsize"> {{ $show->hp }}</p>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <p><img src="{{ asset('dist_frontend/img/instagram.png') }}" alt=""
                                        class="img-fluid iconsize"> {{ $show->instagram }}</p>
                            </div>
                            <div class="col col-12 col-lg-4">
                                <p><img src="{{ asset('dist_frontend/img/twitter.png') }}" alt=""
                                        class="img-fluid iconsize"> {{ $show->twitter }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p class="fs-4">Portofolio</p>
                                        <ol>
                                            <li class="fs-6">Photo</li>
                                            <div class="row">
                                                @foreach ($post as $item)
                                                    @php
                                                        $path_photo = asset('storage/uploads/photo/compress/' . $item->file);
                                                        $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-img2">
                                                                <div class="imgbox2">
                                                                    <img src="{{ $path_photo }}" alt=""
                                                                        class="img-fluid">
                                                                </div>
                                                                <div class="content2">
                                                                    <h5 class="blue6 teks2">{{ $item->name }}</h5>
                                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                                        class="btn btn-primary btn-blue6 mt-2 btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif ($item->urlgd && $item->category_id == '3')
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-vid2">
                                                                <div class="vidbox2">
                                                                    <iframe src="{{ $item->urlgd }}" width="640"
                                                                        height="480" allow="autoplay"></iframe>
                                                                </div>
                                                                <div class="contentvid2">
                                                                    <h5 class="blue6 teks2">{{ $item->name }}
                                                                    </h5>
                                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                                        class="btn btn-primary mt-2 btn-blue6 btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>

                                            <li class="fs-6 mt-5">Video</li>
                                            <div class="row">
                                                @foreach ($post as $item)
                                                    @php
                                                        $path_video = asset('storage/uploads/video/thumbnail/' . $item->thumbnail);
                                                        $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if ($extvideo == 'jpg')
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-vid2">
                                                                <div class="vidbox2">
                                                                    <img src="{{ $path_video }}" alt=""
                                                                        class="img-fluid">
                                                                </div>
                                                                <div class="contentvid2">
                                                                    <h5 class="blue6 teks2">{{ $item->name }}</h5>
                                                                    <a href="{{ route('detail', [$item->name]) }}"
                                                                        class="btn btn-primary btn-blue6 mt-2 text-light btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif ($item->url)
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-vid2">
                                                                <div class="vidbox2">
                                                                    <x-embed url="{{ $item->url }}"
                                                                        aspect-ratio="4:3" />
                                                                </div>
                                                                <div class="contentvid2">
                                                                    <h5 class="blue6 teks2">{{ $item->name }}</h5>
                                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                                        class="btn btn-primary mt-2 btn-blue6 btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif ($item->urlgd && $item->category_id == '4')
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-vid2">
                                                                <div class="vidbox2">
                                                                    <iframe src="{{ $item->urlgd }}" width="640"
                                                                        height="480" allow="autoplay"></iframe>
                                                                </div>
                                                                <div class="contentvid2">
                                                                    <h5 class="blue6 teks2">{{ $item->name }}
                                                                    </h5>
                                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                                        class="btn btn-primary mt-2 btn-blue6 btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <li class="fs-6 mt-5">Audio</li>
                                            <div class="row">
                                                @foreach ($post as $item)
                                                    @php
                                                        $path_audio = asset('storage/uploads/audio/' . $item->file);
                                                        $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if ($extaudio == 'mp3' || $extaudio == 'm4a')
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-audio2">
                                                                <div class="audiobox2">
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
                                                                <div class="contentaudio2 mt-2">
                                                                    <h5 class="mt-2 mx-auto blue6 teks2">
                                                                        {{ $item->name }}
                                                                    </h5>
                                                                    @if ($extaudio == 'mp3')
                                                                        <audio src="{{ $path_audio }}" type="audio/mp3"
                                                                            controls class="waudio"></audio>
                                                                    @endif
                                                                    @if ($extaudio == 'm4a')
                                                                        <audio src="{{ $path_audio }}" type="audio/m4a"
                                                                            controls class="waudio"></audio>
                                                                    @endif
                                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                                        class="btn btn-primary mt-1 btn-blue6 btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif ($item->urlgd && $item->category_id == '5')
                                                        <div class="col col-12 col-md-4 my-2 d-flex justify-content-center"
                                                            data-aos="fade-up" data-aos-duration="1200">
                                                            <div class="card-vid2">
                                                                <div class="vidbox2">
                                                                    <iframe src="{{ $item->urlgd }}" width="640"
                                                                        height="480" allow="autoplay"></iframe>
                                                                </div>
                                                                <div class="contentvid2">
                                                                    <h5 class="blue6 teks2">{{ $item->name }}
                                                                    </h5>
                                                                    <a href="{{ route('detail', [$item->slug]) }}"
                                                                        class="btn btn-primary mt-2 btn-blue6 btn-sm">Detail</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            @if (Auth::guard('web')->check() && Auth::guard('web')->user()->id == $show->id)
                                <div class="col col-12 d-flex justify-content-end">
                                    <a href="{{ route('profile_edit', $show->name) }}"
                                        class="btn btn-sm btn-success">Edit Profile</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
