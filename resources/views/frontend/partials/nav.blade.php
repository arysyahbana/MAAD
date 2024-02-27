<nav class="navbar sticky-top navbar-expand-lg bg-black-custom shadow">
    <div class="container-fluid px-5">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('dist_frontend/img/CODIAS.png') }}"
                alt="" width="50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link mx-4 link mt-1" aria-current="page" href="{{ route('home') }}"><i
                            class="bi bi-house-fill text-light"></i>
                        <span class="text-light"> Home</span></a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ms-4 ms-lg-0 text-light link mt-1" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                                $path_photo = asset('storage/uploads/photo/profil/' . Auth::guard()->user()->foto_profil);
                                $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);
                            @endphp
                            @if ($extphoto == 'jpg' || $extphoto == 'png' || $extphoto == 'jpeg')
                                <img src="{{ asset($path_photo) }}" alt=""
                                    class="foto-profil-nav img-fluid rounded-5">
                                {{-- <img src="{{ asset('dist_frontend/img/profile.jpg') }}" alt=""
                                            class="img-fluid rounded-pill"> --}}
                            @elseif ($extphoto == '')
                                <i class="bi bi-person-circle"></i>
                            @endif

                            {{ Auth::guard()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="{{ route('post_create', [Auth::guard()->user()->name]) }}" class="dropdown-item"><i
                                        class="bi bi-upload"></i>
                                    Upload</a></li>
                            <li><a href="{{ route('post_show', [Auth::guard()->user()->name]) }}" class="dropdown-item"><i
                                        class="bi bi-file-earmark-image"></i>
                                    My Media</a></li>
                            <li><a href="{{ route('like_show', [Auth::guard()->user()->name]) }}" class="dropdown-item"><i
                                        class="bi bi-heart-fill"></i>
                                    Liked</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile', Auth::guard()->user()->name) }}"><i
                                        class="bi bi-file-text"></i>
                                    My Profile</a></li>
                            @if (Auth::guard()->user()->role == 'umum')
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#subscribe"><i class="bi bi-gem"></i>
                                        Unlock Premium</a></li>
                            @else
                            @endif
                            <li><a class="dropdown-item" href="{{ route('user_logout') }}"><i
                                        class="bi bi-box-arrow-left"></i> Logout</a></li>

                        </ul>
                    </li>
                    <li class="nav-link ms-4 dropdown">
                        <button class="btn btn-sm px-0 px-lg-2 dropdown-toggle d-flex align-items-center link"
                            id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                            data-bs-display="static" aria-label="Toggle theme (auto)">
                            <svg class="bi theme-icon-active" style="width: 20px; height: 20px;">
                                <use href="#circle-half"></use>
                            </svg>
                            <span class="d-lg-none ms-2" id="bd-theme-text"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="light" aria-pressed="false">
                                    <svg class="bi me-2 opacity-50 theme-icont" style="width: 20px; height: 20px;">
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
                    <li>
                        <a class="nav-link text-light rounded-4 ms-4 ms-lg-0 mt-1" href="#" role="button"
                            data-bs-toggle="modal" data-bs-target="#order"><i class="bi bi-box-arrow-in-right"></i>
                            Login</a>
                    </li>
                    <li class="nav-link ms-4 dropdown">
                        <button class="btn btn-sm px-0 px-lg-2 dropdown-toggle d-flex align-items-center" id="bd-theme"
                            type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static"
                            aria-label="Toggle theme (auto)">
                            <svg class="bi theme-icon-active" style="width: 20px; height: 20px;">
                                <use href="#circle-half"></use>
                            </svg>
                            <span class="d-lg-none ms-2" id="bd-theme-text"></span>
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
