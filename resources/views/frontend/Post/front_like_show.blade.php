@extends('frontend.layouts2.main2')

@section('title', 'MAD | Liked')

@section('container')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12">
                <div class="container px-5 py-3">
                    <div class="row">
                        <p class="fs-3 text-start">Liked</p>

                        <hr>

                        @foreach ($likePosts as $item)
                            @php
                                $path_photo = asset('storage/uploads/photo/compress/' . $item->file);
                                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                                $path_video = $item->file;
                                $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                                $path_audio = asset('storage/uploads/audio/' . $item->file);
                                $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                            @endphp
                            {{-- Photo --}}
                            @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
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
                            @endif
                            {{-- end Photo --}}

                            {{-- Video --}}
                            @if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm')
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
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
                            @endif
                            {{-- end Video --}}

                            {{-- Youtube --}}
                            @if ($item->url)
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
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
                            @endif
                            {{-- end Youtube --}}

                            {{-- Audio --}}
                            @if ($extaudio == 'mp3' || $extaudio == 'm4a')
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
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
                            @endif
                            {{-- end Audio --}}

                            {{-- Googledrive --}}
                            @if ($item->urlgd)
                                <div class="col col-12 col-md-6 col-lg-3 mt-4" data-aos="fade-up" data-aos-duration="1200">
                                    <div class="card-custom shadow rounded-3 mx-auto">
                                        <iframe src="{{ $item->urlgd }}" width="640" height="480" allow="autoplay"
                                            class="gd"></iframe>
                                        <div class="category-logo">
                                            @if ($item->rCategory->name == 'Photo')
                                                <i class="bi bi-image-fill"></i>
                                            @elseif ($item->rCategory->name == 'Video')
                                                <i class="bi bi-film"></i>
                                            @elseif ($item->rCategory->name == 'Audio')
                                                <i class="bi bi-music-note-beamed"></i>
                                            @endif
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
                            {{-- end Googledrive --}}
                        @endforeach
                        <div class="mt-5 mb-3">
                            {{ $likePosts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
