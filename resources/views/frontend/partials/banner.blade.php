<!-- Awal Banner -->
<div class="container-fluid banner">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('dist_frontend/img/CODIAS.png') }}"
                    alt="" width="50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle text-light px-3 mx-0 mx-lg-2 my-2 my-lg-0 link"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i>
                                    {{ Auth::guard()->user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="{{ route('post_create', [Auth::guard()->user()->name]) }}"
                                            class="dropdown-item"><i class="bi bi-upload"></i>
                                            Upload</a></li>
                                    <li><a href="{{ route('post_show', [Auth::guard()->user()->name]) }}"
                                            class="dropdown-item"><i class="bi bi-file-earmark-image"></i>
                                            My Media</a></li>
                                    <li><a href="{{ route('like_show', [Auth::guard()->user()->name]) }}"
                                            class="dropdown-item"><i class="bi bi-heart-fill"></i>
                                            Liked</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('profile', [Auth::guard()->user()->name]) }}"><i
                                                class="bi bi-file-text"></i>
                                            My Profile</a></li>
                                    @if (Auth::guard()->user()->role == 'umum')
                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#subscribe"><i class="bi bi-gem"></i>
                                                Unlock Premium</a></li>
                                    @else
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('user_logout') }}"><i
                                                class="bi bi-box-arrow-left"></i>
                                            Logout</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <button class="btn btn-sm px-0 px-lg-2 dropdown-toggle d-flex align-items-center link"
                                id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-label="Toggle theme (auto)">
                                <svg class="bi theme-icon-active" style="width: 20px; height: 20px;">
                                    <use href="#circle-half"></use>
                                </svg>
                                <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="light" aria-pressed="false">
                                        <svg class="bi me-2 opacity-50 theme-icon text-light"
                                            style="width: 20px; height: 20px;">
                                            <use href="#sun-fill"></use>
                                        </svg>
                                        Light
                                        <svg class="bi ms-auto d-none">
                                            <use href="#check2"></use>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="dark" aria-pressed="false">
                                        <svg class="bi me-2 opacity-50 theme-icon" style="width: 20px; height: 20px;">
                                            <use href="#moon-stars-fill"></use>
                                        </svg>
                                        Dark
                                        <svg class="bi ms-auto d-none">
                                            <use href="#check2"></use>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="auto" aria-pressed="true">
                                        <svg class="bi me-2 opacity-50 theme-icon" style="width: 20px; height: 20px;">
                                            <use href="#circle-half"></use>
                                        </svg>
                                        Auto
                                        <svg class="bi ms-auto d-none">
                                            <use href="#check2"></use>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="#" class="btn btn-sm btn-orange btn-block text-light link px-3"
                                data-bs-toggle="modal" data-bs-target="#order"><i class="bi bi-box-arrow-in-right"></i> Log
                                in</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user_signup') }}"
                                class="btn btn-sm btn-block text-light link ms-0 ms-lg-2 my-2 my-lg-0"><i
                                    class="bi bi-plus-square"></i>
                                Sign up</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="btn btn-sm btn-block text-light link mx-0 mx-lg-2 mb-2 mb-lg-0"
                                onclick="loginfail()"><i class="bi bi-upload"></i> Upload</a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <button class="btn btn-sm px-0 px-lg-2 dropdown-toggle d-flex align-items-center link"
                                id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-label="Toggle theme (auto)">
                                <svg class="bi theme-icon-active" style="width: 20px; height: 20px;">
                                    <use href="#circle-half"></use>
                                </svg>
                                <span class="d-lg-none ms-2" id="bd-theme-text">Toggle theme</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="light" aria-pressed="false">
                                        <svg class="bi me-2 opacity-50 theme-icon text-light"
                                            style="width: 20px; height: 20px;">
                                            <use href="#sun-fill"></use>
                                        </svg>
                                        Light
                                        <svg class="bi ms-auto d-none">
                                            <use href="#check2"></use>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center"
                                        data-bs-theme-value="dark" aria-pressed="false">
                                        <svg class="bi me-2 opacity-50 theme-icon" style="width: 20px; height: 20px;">
                                            <use href="#moon-stars-fill"></use>
                                        </svg>
                                        Dark
                                        <svg class="bi ms-auto d-none">
                                            <use href="#check2"></use>
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="dropdown-item d-flex align-items-center active"
                                        data-bs-theme-value="auto" aria-pressed="true">
                                        <svg class="bi me-2 opacity-50 theme-icon" style="width: 20px; height: 20px;">
                                            <use href="#circle-half"></use>
                                        </svg>
                                        Auto
                                        <svg class="bi ms-auto d-none">
                                            <use href="#check2"></use>
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </li>


                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    {{--
    <div class="row pt-3">
        <div class="col col-12 col-md-6 col-lg-6">
            <img src="{{ asset('dist_frontend/img/UNP Asset.png') }}" alt="" width="200px">
        </div>

        <div class="col col-12 col-md-6 col-lg-6 d-flex justify-content-end">
            @auth
                <div class="dropdown">
                    <button class="btn btn-light btnwhite dropdown-toggle rounded-pill mx-3 blue1" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                        {{ Auth::guard()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('post_create', [Auth::guard()->user()->id, Auth::guard()->user()->name]) }}"
                                class="dropdown-item"><i class="bi bi-upload"></i>
                                Unggah</a></li>
                        <li><a href="{{ route('post_show', [Auth::guard()->user()->id, Auth::guard()->user()->name]) }}"
                                class="dropdown-item"><i class="bi bi-file-earmark-image"></i>
                                My Media</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile_edit', Auth::guard()->user()->id) }}"><i
                                    class="bi bi-file-text"></i>
                                My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('user_logout') }}"><i class="bi bi-box-arrow-left"></i>
                                Logout</a></li>
                    </ul>
                </div>
            @else
                <a href="#" class="btn btn-light btn-block btnwhite blue1 rounded-pill px-lg-4" data-bs-toggle="modal"
                    data-bs-target="#order"><i class="bi bi-box-arrow-in-right"></i> Log in</a>
                <a href="{{ route('user_signup') }}"
                    class="btn btn btn-primary btnblue1 white rounded-pill px-lg-4 ms-2"><i class="bi bi-plus-square"></i>
                    Sign up</a>
                <a href="{{ route('post_create', ['ads', 'asd']) }}" class="btn btn-success rounded-pill px-4 mx-2"
                    onclick="return alert('Anda tidak login')"><i class="bi bi-upload"></i> Unggah</a>
            @endauth --}}
    {{-- </div>
</div> --}}

    <div class="row justify-content-center pt-lg-5">
        @if (Request::path() == 'photo')
            <div class="col col-12 col-lg-8 d-flex justify-content-center my-5 px-5" data-aos="zoom-in-down"
                data-aos-duration="1200">
                <p class="display-6 fw-bold mt-5 text-center text-light banner-text">STOCK PHOTO GRATIS DARI ORANG
                    BERBAKAT UNIVERSITAS NEGERI PADANG </p>
            </div>
            <div class="col col-12 col-lg-6 text-center">
                {{-- @if (Request::path() == 'photo/{ukuran}')
                    <form action="{{ route('photo/{ukuran}') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control py-3 rounded-start-pill shadow"
                                placeholder="Search.." name="search_photo" value="{{ request('search_photo') }}">
                            <button class="btn warna_search rounded-end-pill" type="submit"><i
                                    class="bi bi-search text-light"></i></button>
                        </div>
                    </form>
                @endif --}}
                <form action="{{ route('photo') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-md shadow" placeholder="Search.."
                            name="search_photo" value="{{ request('search_photo') }}">
                        <button class="btn btn-md btn-danger warna_search" type="submit"><i
                                class="bi bi-search text-light"></i></button>
                    </div>
                </form>
            </div>
        @elseif (Request::path() == 'video')
            <div class="col col-12 col-lg-12 d-flex justify-content-center my-5" data-aos="zoom-in-down"
                data-aos-duration="1200">
                <p class="display-6 fw-bold mt-5 text-center text-light banner-text">REKAMAN & STOCK VIDEO GRATIS DARI
                    ORANG BERBAKAT </p>
            </div>
            <div class="col col-12 col-lg-6 text-center mt-3">
                <form action="{{ route('video') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-md shadow" placeholder="Search.."
                            name="search_video" value="{{ request('search_video') }}">
                        <button class="btn btn-md btn-danger warna_search" type="submit"><i
                                class="bi bi-search text-light"></i></button>
                    </div>
                </form>
            </div>
        @elseif (Request::path() == 'audio')
            <div class="col col-12 col-lg-12 d-flex justify-content-center my-5" data-aos="zoom-in-down"
                data-aos-duration="1200">
                <p class="display-6 fw-bold mt-5 text-center text-light banner-text">REKOMENDASI MUSIK GRATIS DARI
                    ORANG BERBAKAT </p>
            </div>
            <div class="col col-12 col-lg-6 text-center mt-3">
                <form action="{{ route('audio') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-md" placeholder="Search.."
                            name="search_audio" value="{{ request('search_audio') }}">
                        <button class="btn btn-md btn-danger warna_search" type="submit"><i
                                class="bi bi-search text-light"></i></button>
                    </div>
                </form>
            </div>
        @else
            <div class="col col-12 col-lg-7 d-flex justify-content-center my-5" data-aos="zoom-in-down"
                data-aos-duration="1200">
                <p class="display-6 fw-bold mt-5 text-center text-light banner-text">TEMUKAN HAL YANG MENAKJUBKAN DI
                    SEKITAR UNIVERSITAS NEGERI PADANG</p>
            </div>
            <div class="col col-12 col-lg-6 text-center mt-3">
                <form action="{{ route('home') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-md" placeholder="Search.."
                            name="search" value="{{ request('search') }}">
                        <button class="btn btn-md btn-danger warna_search" type="submit"><i
                                class="bi bi-search text-light"></i></button>
                    </div>
                </form>
            </div>
        @endif
        {{-- <div class="col col-12 col-lg-7" data-aos="zoom-in-left" data-aos-duration="1300">
            <hr class="border border-light bg-light border-2 opacity-100">
        </div> --}}

    </div>
</div>
<!-- Akhir Banner -->

<!-- Awal modal -->
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ asset('dist_frontend/img/CODIAS.png') }}" alt="" class="img-fluid"
                    style="height: 60px;">
                <h5 class="fw-normal mx-auto" style="letter-spacing: 1px;">Sign into
                    your
                    account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="{{ route('user_login_submit') }}" method="post">
                        @csrf
                        <div class="py-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control form-control-sm" name='email' id="email"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control form-control-sm" name='password'
                                id="password">
                        </div>
                        <input type="submit" class="btn btn-success btn-block btn-sm px-4" value="Login">
                        <div class="mt-3">
                            <a href="{{ route('user_forget') }}" class="small text-muted text-decoration-none">Forget
                                password?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Akhir modal -->

{{-- Modal Subscribe --}}
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
                    <p>Tingkatkan akun anda menjadi premium agar bisa mengakses file-file yang belum bisa anda akses</p>
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
