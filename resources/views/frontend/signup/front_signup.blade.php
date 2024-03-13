<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('dist_frontend/img/CODIAS.png') }}" type="image/png">
    <title>SignUp</title>
    @include('frontend.layouts.cssfront')
    @include('frontend.layouts.jsfront')
</head>

<body>
    <div class="header">
        <!--Content before waves-->
        <div class="inner-header">
            <section class="vh-100">
                <div class="container pt-5">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col col-xl-10">
                            <div class="card shadow z-3" style="border-radius: 1rem;">
                                <div class="row g-0">
                                    <div class="col-md-6 col-lg-5 d-none d-md-block">
                                        <img src="{{ asset('dist_frontend/img/pro.jpg') }}" alt="login form"
                                            class="img-fluid"
                                            style="border-radius: 1rem 0 0 1rem; height: 100%; object-fit: cover;" />
                                    </div>
                                    <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                        <div class="card-body p-4 p-lg-5 text-black">

                                            <form action="{{ route('signup_submit') }}" method="post">
                                                @csrf
                                                <div class="d-flex align-items-center mb-3 pb-1">
                                                    <img src="{{ asset('dist_frontend/img/CODIAS.png') }}"
                                                        alt="" class="img-fluid" style="height: 60px;">
                                                    <h5 class="fw-normal mx-auto" style="letter-spacing: 1px;">Sign Up
                                                        to
                                                        Join With Us
                                                    </h5>
                                                </div>

                                                <div class="row">
                                                    <div class="col col-12">
                                                        <div class="form-outline text-start mt-2">
                                                            <label class="form-label">Nama</label>
                                                            <input type="text" class="form-control" name='name'
                                                                id="name">
                                                        </div>
                                                    </div>
                                                    <div class="col col-12">
                                                        <div class="form-outline text-start mt-2">
                                                            <label class="form-label">Alamat Email</label>
                                                            <input type="email" class="form-control" name='email'
                                                                id="email" aria-describedby="emailHelp">
                                                        </div>
                                                    </div>
                                                    <div class="col col-6">
                                                        <div class="form-outline text-start mt-2">
                                                            <label class="form-label">NIM</label>
                                                            <input class="form-control form-control-md" type="number"
                                                                aria-label=".form-control-lg example" name="nim">
                                                        </div>
                                                    </div>
                                                    <div class="col col-6">
                                                        <div class="form-outline text-start mt-2">
                                                            <label class="form-label">No HP</label>
                                                            <input type="number" class="form-control" name='hp'
                                                                id="hp">
                                                        </div>
                                                    </div>
                                                    <div class="col col-12">
                                                        <div class="form-outline text-start mt-2">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <label for="gender" class="form-label">Jenis
                                                                        Kelamin <span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="row">
                                                                        <div class="col col-2">
                                                                            <div class="form-check-info">
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                        class="form-check-input"
                                                                                        name="gender" id="male"
                                                                                        value="Pria">
                                                                                    Pria
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col col-3">
                                                                            <div class="form-check-info">
                                                                                <!-- Sesuaikan nilai margin sesuai kebutuhan -->
                                                                                <label class="form-check-label">
                                                                                    <input type="radio"
                                                                                        class="form-check-input"
                                                                                        name="gender" id="female"
                                                                                        value="Wanita">
                                                                                    Wanita
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col col-12">
                                                        <div class="form-outline text-start mt-2">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" class="form-control" name='password'
                                                                id="password">
                                                        </div>
                                                    </div>
                                                    <div class="col col-12">
                                                        <div class="form-outline text-start mt-2">
                                                            <label class="form-label">Retype Password</label>
                                                            <input type="password" class="form-control"
                                                                name='password_confirmation' id="password_confirmation">
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="pt-1 my-2 text-start">
                                                    <button class="btn btn-success btn-block"
                                                        type="submit">Submit</button>
                                                </div>

                                                <div class="text-start">
                                                    <a class="small text-muted text-decoration-none"
                                                        href="{{ route('home') }}">Ingin Login?</a>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!--Waves Container-->
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->
    </div>
    <!--Header ends-->
    <!--Content starts-->
    <div class="content-wave flex"></div>
    <!--Content ends-->
</body>
@include('frontend.layouts.jsfrontfooter')

</html>
