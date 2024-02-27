<nav class="navbar sticky-top navbar-expand-lg bg-black shadow-lg">
    <div class="container justify-content-center text-center p-3">
        <div class="col col-12 col-lg-3 pt-2 pt-md-0 pt-lg-0">
            <a href="{{ route('home') }}"
                class="text-decoration-none fs-6 {{ Request::is('/') ? 'text-orange' : 'text-light' }} link"><i
                    class="bi bi-house-fill"></i> Home</a>
        </div>

        <div class="col col-12 col-lg-3 pt-2 pt-md-0 pt-lg-0">
            <a href="{{ route('photo') }}"
                class="text-decoration-none fs-6 {{ Request::is('photo', 'photo/*') ? 'text-orange' : 'text-light' }} link"><i
                    class="bi bi-camera-fill"></i> Photo</a>
        </div>

        <div class="col col-12 col-lg-3 pt-2 pt-md-0 pt-lg-0">
            <a href="{{ route('video') }}"
                class="text-decoration-none fs-6 {{ Request::is('video') ? 'text-orange' : 'text-light' }} link"><i
                    class="bi bi-camera-reels-fill"></i> Video</a>
        </div>

        <div class="col col-12 col-lg-3 pt-2 pt-md-0 pt-lg-0">
            <a href="{{ route('audio') }}"
                class="text-decoration-none fs-6 {{ Request::is('audio') ? 'text-orange' : 'text-light' }} link"><i
                    class="bi bi-file-earmark-music-fill"></i> Audio</a>
        </div>
    </div>
</nav>
