@extends('frontend.layouts2.main2')

@section('title', 'MAD | Upload')

@section('container')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col col-12">

                {{-- <h5 class="card-title">Card title</h5> --}}
                <div class="container px-5 py-3">
                    <div class="row">
                        <div class="col col-8">
                            <p class="fs-3">Upload Post</p>
                        </div>
                        <div class="col col-lg-4 text-end">
                            <button class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#ketentuan">
                                <i class="bi bi-lock-fill"></i>
                            </button>
                        </div>
                    </div>

                    <hr>
                    <form action="{{ route('post_store') }}" method="post" enctype="multipart/form-data" id="uploadForm">
                        @csrf

                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="form-label">Judul</label>
                            <input class="form-control" type="text" aria-label=".form-control-lg example" name="title">
                        </div>

                        <div class="row">
                            <div class="col col-12 col-lg-8">
                                <div class="mb-lg-4" id="input1">
                                    <label for="" class="form-label">Masukkan file</label>
                                    <input class="form-control" type="file" name="file" id="file">
                                </div>

                                <div class="mb-lg-4" id="input2" style="display: none">
                                    <label for="" class="form-label">Masukkan link youtube</label>
                                    <input class="form-control" type="text" name="linkyt">
                                </div>

                                <div class="mb-lg-4" id="input3" style="display: none">
                                    <label for="" class="form-label">Masukkan link googledrive</label>
                                    <input class="form-control" type="text" name="linkgd">
                                </div>
                            </div>

                            <div class="col col-12 col-lg-4 pt-2">
                                <div class="row mb-4 mb-lg-0 mt-lg-4">
                                    <div class="col col-12 col-lg-4" id="button1Container">
                                        <a href="#" class="btn btn-small btn-outline-warning" id="button1">Local
                                            <img class="shadow" src="{{ asset('dist_frontend/img/folder.png') }}"
                                                alt="" style="max-width: 20px" /></a>
                                    </div>
                                    <div class="col col-12 col-lg-5" id="button2Container">
                                        <a href="#" class="btn btn-small btn-outline-danger" id="button2">Youtube
                                            <img class="shadow" src="{{ asset('dist_frontend/img/youtube.png') }}"
                                                alt="" style="max-width: 20px" /></a>
                                    </div>
                                    <div class="col col-12 col-lg-6" id="button3Container">
                                        <a href="#" class="btn btn-small btn-outline-primary" id="button3">
                                            GoogleDrive
                                            <img class="shadow" src="{{ asset('dist_frontend/img/drive.png') }}"
                                                alt="" style="max-width: 20px" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-12 col-lg-8">
                                <div class="mb-lg-4" id="input4">
                                    <label for="" class="form-label">Masukkan file project</label>
                                    <input class="form-control" type="file" name="file2">

                                </div>

                                <div class="mb-lg-4" id="input5" style="display: none">
                                    <label for="" class="form-label">Masukkan link googledrive file project</label>
                                    <input class="form-control" type="text" name="file2Link">

                                </div>
                            </div>
                            <div class="col col-12 col-lg-4 pt-2">
                                <div class="row mb-4 mb-lg-0 mt-lg-4">
                                    <div class="col col-12 col-lg-4" id="button4Container">
                                        <a href="#" class="btn btn-small btn-outline-warning" id="button4"
                                            onclick="">Local
                                            <img src="{{ asset('dist_frontend/img/folder.png') }}" alt=""
                                                style="max-width: 20px" /></a>
                                    </div>

                                    <div class="col col-12 col-lg-6" id="button5Container">
                                        <a href="#" class="btn btn-small btn-outline-primary" id="button5"
                                            onclick="">GoogleDrive
                                            <img src="{{ asset('dist_frontend/img/drive.png') }}" alt=""
                                                style="max-width: 20px" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3" id="input6">
                            <label>Kategori</label>
                            <select name="category_menu" class="form-select form-select-sm mt-2" id="category_menu">
                                <option value="">Pilih Menu...</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea class="form-control form-control-lg fs-6" id="" rows="3" name="body"></textarea>
                        </div>

                        <div class="text-end mt-4" id="upBtn">
                            <input type="submit" class="btn btn-success px-4 py-2" value="Uploads">
                        </div>
                        <div class="text-end mt-4" style="display: none" id="uploadingBtn">
                            <button disabled type="submit" class="btn btn-success px-4 py-2">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                Uploading...
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ketentuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Ketentuan untuk upload
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fw-bold">Upload File</p>
                    <ol>
                        <li>Upload di local untuk sekarang hanya bisa di bawah 10 MB</li>
                        <li>
                            Jika ingin mengupload File dengan ukuran lebih dari 10 MB,
                            disarankan untuk menyematkan link google drive
                        </li>
                        <li>
                            Untuk upload video, sangat disarankan untuk menyematkan link
                            youtube
                        </li>
                        <li>
                            Pastikan kategori yang dipilih sesuai dengan file yang diupload
                        </li>
                        <li>
                            Khusus untuk link youtube tidak perlu untuk memilih kategori
                        </li>
                    </ol>
                    <p class="fw-bold">Cara ambil link google drive untuk disematkan</p>
                    <ol>
                        <li>
                            Pastikan untuk memberikan izin akses ke siapa saja yang memiliki
                            link.
                        </li>
                        <li>
                            Buka file di googledirve, setelah itu pilih titik 3 di pojok
                            kanan atas, pilih buka di jendela baru
                        </li>
                        <li>Copy link di jendela baru itu, baru lakukan upload disini</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
