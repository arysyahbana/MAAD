{{-- Awal Nav2 --}}
<div class="container-fluid mt-5 pt-5 sticky-top">
    @auth
        {{-- @if (Auth::guard('web')->user()->id == ) --}}
            @if (Request::is('posts/create/*') ||
                    Request::is('posts/show/*') ||
                    Request::is('like/*') ||
                    $page == 'premium' ||
                    Auth::guard()->check() && Auth::user()->id == $show->id)
                <center>
                    <div class="row text-center container">
                        <div class="col col-3" data-aos="zoom-out-up" data-aos-duration="1000">
                        <a href="{{ route('post_create', [Auth::guard()->user()->name]) }}" class="text-decoration-none {{ Request::is('posts/create/*') ? 'active text-orange' : 'text-dark' }}">
                            <i class="bi bi-upload fs-5"></i>
                            <p>Upload</p>
                        </a>
                    </div>
                    <div class="col col-3" data-aos="zoom-out-up" data-aos-duration="1000">
                        <a href="{{ route('post_show', [Auth::guard()->user()->name]) }}" class="text-decoration-none {{ Request::is('posts/show/*') ? 'active text-orange' : 'text-dark' }}">
                            <i class="bi bi-file-earmark-image fs-5"></i>
                            <p>My Media</p>
                        </a>
                    </div>
                    <div class="col col-3" data-aos="zoom-out-up" data-aos-duration="1000">
                        <a href="{{ route('like_show', [Auth::guard()->user()->name]) }}" class="text-decoration-none {{ Request::is('like/show/*') ? 'active text-orange' : 'text-dark' }}">
                            <i class="bi bi-heart-fill fs-5"></i>
                            <p>Liked</p>
                        </a>
                    </div>
                    <div class="col col-3" data-aos="zoom-out-up" data-aos-duration="1000">
                        <a href="{{ route('profile', Auth::guard()->user()->name) }}" class="text-decoration-none {{ Request::is('profile/*') ? 'active text-orange' : 'text-dark' }}">
                            <i class="bi bi-file-text fs-5"></i>
                            <p>My Profile</p>
                        </a>
                    </div>
                </div>
                </center>

                {{-- <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link  mx-lg-4 {{ Request::is('posts/show/*') ? 'active text-danger' : 'text-dark' }}"
                            href="{{ route('post_show', [Auth::guard()->user()->name]) }}"><i
                                class="bi bi-file-earmark-image"></i> My
                            Media</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none mx-lg-4  {{ Request::is('posts/create/*') ? 'active text-danger' : 'text-dark' }}"
                            href="{{ route('post_create', [Auth::guard()->user()->name]) }}"><i
                                class="bi bi-upload"></i> Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none mx-lg-4  {{ Request::is('like/show/*') ? 'active text-danger' : 'text-dark' }}"
                            href="{{ route('like_show', [Auth::guard()->user()->name]) }}"><i
                                class="bi bi-heart-fill"></i> Liked</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none mx-lg-4  {{ Request::is('profile/*') ? 'active text-danger' : 'text-dark' }}"
                            href="{{ route('profile', Auth::guard()->user()->name) }}"><i class="bi bi-file-text"></i>
                            Profile</a>
                    </li>
                </ul> --}}
            @endif
        {{-- @else
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link text-decoration-none mx-lg-4  {{ Request::is('profile/*') ? 'active text-danger' : 'text-dark' }}"
                        href="{{ route('profile', Auth::guard()->user()->id) }}"><i class="bi bi-file-text"></i>
                        Profile</a>
                </li>
            </ul>
        @endif --}}
    @endauth

</div>
{{-- Akhir Nav2 --}}
