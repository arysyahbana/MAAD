@extends('frontend.layouts2.main2')

@section('title', 'MAD | Edit')

@section('container')
    <div class="container">
        <div class="col col-12 mb-5">
            <h4 class="card-title fs-4 fw-bold text-start pt-3">Edit Post</h4>
        </div>
        <form action="{{ route('post_update', $edit->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                    name="title" value="{{ $edit->name }}">
            </div>

            @php
                $path_photo = asset('storage/uploads/photo/' . $post->file);
                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                $path_video = $post->file;
                $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                $path_audio = asset('storage/uploads/audio/' . $post->file);
                $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                $path_raw_photo = asset('storage/uploads/rawphoto/' . $post->file_mentah);
                $extrawphoto = pathinfo($path_raw_photo, PATHINFO_EXTENSION);

                $path_raw_video = asset('storage/uploads/rawvideo/' . $post->file_mentah);
                $extrawvideo = pathinfo($path_raw_video, PATHINFO_EXTENSION);

                $path_raw_audio = asset('storage/uploads/rawaudio/' . $post->file_mentah);
                $extrawaudio = pathinfo($path_raw_audio, PATHINFO_EXTENSION);

            @endphp

            @if ($edit->url == '' && $edit->urlgd == '')
                {{-- Menampilkan File --}}
                <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">File Lama</label>
                    <div class="row">
                        {{-- Photo --}}
                        @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                            <div class="col col-12 col-lg-8">
                                <div class="card shadow">
                                    <div class="card-body text-center" style="max-height:52rem;">
                                        <img src="{{ asset($path_photo) }}" class="img-fluid rounded-start shadow"
                                            alt="..." style="max-height: 50rem">
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- end Photo --}}

                        {{-- Video --}}
                        @if ($extvideo == 'mp4' || $extvideo == 'mkv' || $extvideo == 'webm')
                            <div class="col col-12 col-lg-8">
                                <div class="card shadow">
                                    <video class="object-fit-contain" controls style="max-height:52rem;">
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
                            </div>
                        @endif
                        {{-- end Video --}}

                        {{-- Audio --}}
                        @if ($extaudio == 'mp3' || $extaudio == 'm4a')
                            <div class="col col-12 col-lg-8">
                                <div class="card shadow">
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
                            </div>
                        @endif
                        {{-- end Audio --}}
                    </div>
                </div>
                {{-- end  Menampilkan File --}}

                <div class="mb-4">
                    <label for="" class="form-label">File Baru</label>
                    <input class="form-control" type="file" name="file">
                    <label for="" class="small text-success">* Ukuran File Maksimal <span class="text-danger">10
                            MB</span></label>
                </div>
                @if ($post->file_mentah)
                    <div class="mb-4">
                        <label for="" class="form-label">File project sebelumnya</label><br>
                        <div class="row">
                            <div class="col col-3">
                                @if ($extrawphoto || $extrawvideo || $extrawaudio)
                                    <div class="card shadow rounded-3">
                                        <div class="p-2 text-center">
                                            <span class="display-1"><i class="bi bi-file-zip-fill"></i></span><br>
                                            <span class="small">{{ $edit->file_mentah }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                @endif
                <div class="mb-4">
                    <label for="" class="form-label">Ganti file project</label>
                    <input class="form-control" type="file" name="file2">
                    <label for="" class="small text-success">* Ukuran File Maksimal <span class="text-danger">10
                            MB</span></label>
                </div>
                <div class="mb-4" id="input6">
                    <label for="" class="form-label">Ganti link googledrive file project</label>
                    <input class="form-control" type="text" name="file2Link" value="{{ $edit->fpgd }}">
                    <label for="" class="small text-success">* Jika Ukuran File lebih dari <span
                            class="text-danger">10 MB</span></label><br>
                    <label for="" class="small text-success">* Izinkan akses ke siapa
                        saja yang memiliki link</label>
                </div>
                {{-- <div class="form-group mb-3" id="input5">
                                        <label>Kategori</label>
                                        <select name="category_menu" class="form-select" id="category_menu">
                                            <option>Pilih Menu...</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
            @elseif ($edit->url)
                <div class="mb-4" id="input2">
                    <label for="" class="form-label">Video youtube sebelumnya</label>
                    <x-embed url="{{ $edit->url }}" aspect-ratio="16:9" />
                </div>
                <div class="mb-4" id="input2">
                    <label for="" class="form-label">Ganti link youtube</label>
                    <input class="form-control" type="text" name="linkyt" value="{{ $edit->url }}">
                </div>
                @if ($post->file_mentah)
                    <div class="mb-4">
                        <label for="" class="form-label">File project sebelumnya</label><br>
                        <div class="row">
                            <div class="col col-3">
                                @if ($extrawphoto || $extrawvideo || $extrawaudio)
                                    <div class="card shadow rounded-3">
                                        <div class="p-2 text-center">
                                            <span class="display-1"><i class="bi bi-file-zip-fill"></i></span><br>
                                            <span class="small">{{ $edit->file_mentah }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                @endif
                <div class="mb-4">
                    <label for="" class="form-label">Ganti file project</label>
                    <input class="form-control" type="file" name="file2">
                    <label for="" class="small text-success">* Ukuran File Maksimal <span class="text-danger">10
                            MB</span></label>
                </div>
                <div class="mb-4" id="input6">
                    <label for="" class="form-label">Ganti link googledrive file project</label>
                    <input class="form-control" type="text" name="file2Link" value="{{ $edit->fpgd }}">
                    <label for="" class="small text-success">* Jika Ukuran File lebih dari <span
                            class="text-danger">10 MB</span></label><br>
                    <label for="" class="small text-success">* Izinkan akses ke siapa
                        saja yang memiliki link</label>
                </div>
            @elseif ($edit->urlgd)
                <div class="mb-4" id="input2">
                    <label for="" class="form-label">Sematan Googledrive sebelumnya</label><br>
                    <iframe src="{{ $edit->urlgd }}" width="640" height="380" allow="autoplay"></iframe>
                </div>
                <div class="mb-4" id="input3">
                    <label for="" class="form-label">Ganti link googledrive</label>
                    <input class="form-control" type="text" name="linkgd" value="{{ $edit->urlgd }}">
                    <label for="" class="small text-success">* Pastikan telah memberi izin akses ke siapa
                        saja yang memiliki link</label>
                </div>
                @if ($post->file_mentah)
                    <div class="mb-4">
                        <label for="" class="form-label">File project sebelumnya</label><br>
                        <div class="row">
                            <div class="col col-3">
                                @if ($extrawphoto || $extrawvideo || $extrawaudio)
                                    <div class="card shadow rounded-3">
                                        <div class="p-2 text-center">
                                            <span class="display-1"><i class="bi bi-file-zip-fill"></i></span><br>
                                            <span class="small">{{ $edit->file_mentah }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                @endif
                <div class="mb-4">
                    <label for="" class="form-label">Ganti file project</label>
                    <input class="form-control" type="file" name="file2">
                    <label for="" class="small text-success">* Ukuran File Maksimal <span class="text-danger">10
                            MB</span></label>
                </div>
                <div class="mb-4" id="input6">
                    <label for="" class="form-label">Ganti link googledrive file project</label>
                    <input class="form-control" type="text" name="file2Link" value="{{ $edit->fpgd }}">
                    <label for="" class="small text-success">* Jika Ukuran File lebih dari <span
                            class="text-danger">10 MB</span></label><br>
                    <label for="" class="small text-success">* Izinkan akses ke siapa
                        saja yang memiliki link</label>
                </div>

                {{-- <div class="form-group mb-3" id="input5">
                                        <label>Kategori</label>
                                        <select name="category_menu" class="form-select" id="category_menu">
                                            <option>Pilih Menu...</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
            @endif



            <div class="my-4">
                <label for="" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="" rows="3" name="body">{{ $edit->body }}</textarea>
            </div>

            <div class="text-end">
                <input type="submit" class="btn btn-success px-4 py-2" value="Update Post">
            </div>
        </form>
    </div>
@endsection
