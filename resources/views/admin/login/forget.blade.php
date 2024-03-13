<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('dist_frontend/img/CODIAS.png') }}" type="image/png">
    <title>Forget</title>
    @include('frontend.layouts.cssfront')
    @include('frontend.layouts.jsfront')
</head>

<body>
    <div class="header">
        <!--Content before waves-->
        <div class="inner-header">
            <section class="vh-100">
                <div class="container pt-5">
                    <div class="row d-flex justify-content-center align-items-center h-100 pt-5 mt-5">
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

                                            <form action="{{ route('admin_forget_submit') }}" method="post">
                                                @csrf
                                                <div class="d-flex align-items-center mb-3 pb-1">
                                                    <img src="{{ asset('dist_frontend/img/CODIAS.png') }}"
                                                        alt="" class="img-fluid" style="height: 60px;">
                                                    <h5 class="fw-normal mx-auto" style="letter-spacing: 1px;">Reset
                                                        your password</h5>
                                                </div>


                                                <div class="form-outline mt-4 text-start">
                                                    <label class="form-label">Email address</label>
                                                    <input type="email" class="form-control" name='email'
                                                        id="email" aria-describedby="emailHelp">
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="pt-1 my-4 text-start">
                                                    <button class="btn btn-success btn-block" type="submit">Send
                                                        Password
                                                        Reset Link</button>
                                                </div>

                                                <div class="text-start">
                                                    <a class="small text-muted text-decoration-none"
                                                        href="{{ route('admin_login') }}">Back to login
                                                        page</a>
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

    @include('frontend.layouts.jsfrontfooter')
</body>

</html>
