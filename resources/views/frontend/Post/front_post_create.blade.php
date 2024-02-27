@extends('frontend.layouts2.main2')

@section('title', 'MAD | Upload')

@section('container')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12">

                {{-- <h5 class="card-title">Card title</h5> --}}
                <div class="container px-5 py-3">
                    <p class="fs-3" id="icon1"><img src="{{ asset('dist_frontend/img/folder.png') }}" alt=""
                            class="iconps me-3">Upload File</p>
                    <p class="fs-3" id="icon2" style="display: none"><img
                            src="{{ asset('dist_frontend/img/youtube.png') }}" alt="" class="iconps me-3">Sematkan
                        Link YouTube</p>
                    <p class="fs-3" id="icon3" style="display: none"><img
                            src="{{ asset('dist_frontend/img/drive.png') }}" alt="" class="iconps me-3">Sematkan
                        Link Googledrive</p>
                    <hr>
                    <form action="{{ route('post_store') }}" method="post" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <div class="mb-4 icon" id="uplink">
                            <a href="#" class="btn btn-small" id="button1" onclick=""><img
                                    src="{{ asset('dist_frontend/img/folder.png') }}" alt="" class="iconyd"></a>
                            <a href="#" class="btn btn-small" id="button2" onclick=""><img
                                    src="{{ asset('dist_frontend/img/youtube.png') }}" alt="" class="iconyd"></a>
                            <a href="#" class="btn btn-small" id="button3" onclick=""><img
                                    src="{{ asset('dist_frontend/img/drive.png') }}" alt="" class="iconyd"></a>
                        </div>

                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="form-label">Judul</label>
                            <input class="form-control" type="text" aria-label=".form-control-lg example" name="title">
                        </div>

                        <div class="mb-4" id="input1">
                            <label for="" class="form-label">Masukkan file</label>
                            <input class="form-control" type="file" name="file" id="file">
                            <label for="" class="small text-success">* Ukuran File Maksimal <span
                                    class="text-danger">10 MB</span></label>
                        </div>

                        <div class="mb-4" id="input2" style="display: none">
                            <label for="" class="form-label">Masukkan link youtube</label>
                            <input class="form-control" type="text" name="linkyt">
                        </div>

                        <div class="mb-4" id="input3" style="display: none">
                            <label for="" class="form-label">Masukkan link googledrive</label>
                            <input class="form-control" type="text" name="linkgd">
                            <label for="" class="small text-success">* Izinkan akses ke siapa
                                saja yang memiliki link</label>
                        </div>

                        <div class="mb-4" id="input4">
                            <label for="" class="form-label">Masukkan file project</label>
                            <input class="form-control" type="file" name="file2">
                            <label for="" class="small text-success">* Ukuran File Maksimal <span
                                    class="text-danger">10 MB</span></label>
                        </div>

                        <div class="mb-4" id="input6">
                            <label for="" class="form-label">Masukkan link googledrive file project</label>
                            <input class="form-control" type="text" name="file2Link">
                            <label for="" class="small text-success">* Jika Ukuran File lebih dari <span
                                    class="text-danger">10
                                    MB</span></label><br>
                            <label for="" class="small text-success">* Izinkan akses ke siapa
                                saja yang memiliki link</label>
                        </div>

                        <div class="form-group mb-3" id="input5">
                            <label>Kategori</label>
                            <select name="category_menu" class="form-select form-select-sm" id="category_menu">
                                <option>Pilih Menu...</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea class="form-control form-control-lg fs-6" id="" rows="3" name="body"></textarea>
                        </div>


                        {{-- <div class="progress mt-3" role="progressbar" aria-label="Animated striped example"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"></div>
                                </div> --}}
                        {{-- <div class="">
                                    <label for="progress-bar">0%</label>
                                    <progress id="progress-bar" value="0" max="100"></progress>
                                </div> --}}

                        <div class="text-end mt-4">
                            <input type="submit" class="btn btn-success px-4 py-2" value="Uploads">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
