<div class="mt-5 {{ $page == 'Photo' || ($page == 'Video' && $page == 'Audio') ? 'pt-3' : 'pt-5' }}">
    <div class="row">
        @if (Auth::guard('web')->check() && Auth::guard('web')->user()->id == $show->id)
            @if (
                $page !== 'edit' &&
                    $page !== 'showPost' &&
                    $page !== 'upload' &&
                    $page !== 'like' &&
                    $page !== 'premium' &&
                    $page !== 'choice' &&
                    $page !== 'pay' &&
                    $page !== 'invoice' &&
                    $page !== 'editPost')
                <div class="col col-12 d-flex justify-content-end">
                    <a href="{{ route('profile_edit', Auth::user()->name) }}" class="btn btn-sm bg-orange btn-danger">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
                </div>
            @endif
        @endif
    </div>
    <div class="text-center">
        @php
            $path_photo = asset('storage/uploads/photo/profil/' . $show->foto_profil);
            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
        @endphp
        @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
            <div class="foto-profil rounded-pill shadow">
                <img src="{{ asset($path_photo) }}" alt="" class="img-fluid rounded-pill">
            </div>
        @elseif ($extphoto == '')
            <div class="pt-5">
                <i class="bi bi-person-circle display-2 text-light"></i>
            </div>
        @endif
    </div>
    <div class="text-center text-light">
        <p class="text-center fs-5 fw-bold mt-3 ">{{ $show->name }} @if ($show->role == 'premium')
                <i class="bi bi-gem"></i>
            @else
            @endif
        </p>
        <p class="text-center fs-6 ">{{ $show->nim }}</p>
    </div>
    <div class="row text-light">
        <div class="col col-6 text-center">

            <p><i class="bi bi-journal-text fs-6 "></i> <span class="">&nbsp{{ $show->rPost->count() }}
                    Post</span>
            </p>
        </div>
        <div class="col col-6 text-center">
            <p><i class="bi bi-lightbulb-fill fs-6 "></i> <span class="">
                    &nbsp{{ $show->skill ?: 'Belum update profile' }}</span>
            </p>
        </div>
    </div>
</div>

{{-- navigasi --}}
@include('frontend.partials.navup')
{{-- end navigasi --}}

@if (Request::is('profile/*'))
    <hr>
    <div class="row text-center">
        <div class="col col-12">
            <div class="card">
                <div class="card-body text-black-custom">
                    <p class="text-start fw-bold">About me...</p>
                    <p class="small">
                        @if ($show->about)
                            {{ $show->about }}
                        @else
                            Belum ditambahkan
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="row mt-3 text-center text-black-custom">
        <div class="col col-12">
            <p class="small"><i class="bi bi-person-workspace"></i> Status : {{ $show->status }}</p>
        </div>
        <div class="col col-12">
            <p class="small"><i class="bi bi-house-gear-fill"></i>
                @if ($show->status == 'Bekerja')
                    {{ $show->place }}
                @elseif ($show->status == 'Tidak Bekerja')
                    Tidak ada keterangan
                @endif
            </p>
        </div>
        <div class="col col-12">
            <p class="small"><i class="bi bi-clock"></i> Kontrak :
                @if ($show->status == 'Bekerja')
                    {{ \Carbon\Carbon::parse($show->contract)->format('d F Y') }}
                @elseif ($show->status == 'Tidak Bekerja')
                    Tidak ada kontrak
                @endif
            </p>
        </div>
    </div>

    <hr>

    <div class="row text-center text-black-custom">
        <div class="col col-12 col-lg-4">
            <p><img src="{{ asset('dist_frontend/img/whatsapp.png') }}" alt="" class="img-fluid iconsize">
                <br>
                <span class="small">
                    @if ($show->hp)
                        {{ $show->hp }}
                    @else
                        Belum ditambahkan
                    @endif
                </span>
            </p>
        </div>
        <div class="col col-12 col-lg-4">
            <p><img src="{{ asset('dist_frontend/img/instagram.png') }}" alt="" class="img-fluid iconsize">
                <br>
                <span class="small">
                    @if ($show->instagram)
                        {{ $show->instagram }}
                    @else
                        Belum ditambahkan
                    @endif
                </span>
            </p>
        </div>
        <div class="col col-12 col-lg-4">
            <p><img src="{{ asset('dist_frontend/img/twitter.png') }}" alt="" class="img-fluid iconsize">
                <br>
                <span class="small">
                    @if ($show->twitter)
                        {{ $show->twitter }}
                    @else
                        Belum ditambahkan
                    @endif
                </span>
            </p>
        </div>
    </div>
@endif
