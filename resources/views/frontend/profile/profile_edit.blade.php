@extends('frontend.layouts2.main2')

@section('title', 'MAD | Update Profile')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-12 mb-5">
                <h4 class="card-title fs-4 fw-bold text-start pt-3">Edit Profile</h4>
            </div>
            <div class="col col-12">
                <form action="{{ route('profile_update', $show->name) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="name" value="{{ $show->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="nim" value="{{ $show->nim }}">
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-group">
                            <label for="gender" class="form-label">Jenis Kelamin <span
                                    class="text-danger">*</span></label>
                            <div class="form-check-info">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="male"
                                        value="Pria" {{ $show->gender == 'Pria' ? 'checked' : '' }}> Pria
                                </label>
                            </div>
                            <div class="form-check-info">
                                <!-- Sesuaikan nilai margin sesuai kebutuhan -->
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="female"
                                        value="Wanita" {{ $show->gender == 'Wanita' ? 'checked' : '' }}> Wanita
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Skill</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="skill" value="{{ $show->skill }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control form-control-md" type="email" aria-label=".form-control-lg example"
                            name="email" value="{{ $show->email }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No HP</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="hp" value="{{ $show->hp }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto Profil</label>
                        @php
                            $path_photo = asset('storage/uploads/photo/profil/' . $show->foto_profil);
                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                        @endphp
                        @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                            <div class="profil-show rounded-pill foto-profil">
                                <img src="{{ asset($path_photo) }}" alt="" class="img-fluid rounded-pill">
                            </div>
                        @endif
                        <input class="form-control form-control-md mt-3" type="file"
                            aria-label=".form-control-lg example" name="foto_profil">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">About</label>
                        <textarea class="form-control" id="" rows="3" name="about">{{ $show->about }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Instagram</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="instagram" value="{{ $show->instagram }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Twitter</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="twitter" value="{{ $show->twitter }}">
                    </div>

                    <div class="form-group mb-3">
                        <div class="form-group">
                            <label for="gender" class="form-label">Status</label>
                            <div class="form-check-info">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="Bekerja"
                                        value="Bekerja" {{ $show->status == 'Bekerja' ? 'checked' : '' }}> Bekerja
                                </label>
                            </div>
                            <div class="form-check-info">
                                <!-- Sesuaikan nilai margin sesuai kebutuhan -->
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" id="Tidak Bekerja"
                                        value="Tidak Bekerja" {{ $show->status == 'Tidak Bekerja' ? 'checked' : '' }}>
                                    Tidak Bekerja
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tempat Bekerja</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="place" value="{{ $show->place }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kontrak Kerja</label>
                        <input class="form-control form-control-md" type="date" aria-label=".form-control-lg example"
                            name="contract" value="{{ $show->contract }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-md" type="password" aria-label=".form-control-lg example"
                            name="password">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Retype Password</label>
                        <input class="form-control form-control-md" type="password" aria-label=".form-control-lg example"
                            name="password_confirmation">
                    </div>

                    <div class="text-end">
                        <input type="submit" class="btn btn-success px-4 py-2" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
