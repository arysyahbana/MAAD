@extends('frontend.layouts2.main2')

@section('title', 'MAD | Go Premium')

@section('container')
    <div class="container">
        <div class="row mb-5">
            <div class="col col-12 mb-5">
                <h4 class="card-title fs-4 fw-bold text-start pt-3">Choose your plan</h4>
            </div>
            <div class="col col-12 col-lg-6 text-center">
                <div class="card shadow">
                    <div class="card-header bg-black-custom text-light">
                        <div class="row">
                            <div class="col col-6 fw-bold">What You Get</div>
                            <div class="col col-3 fw-bold">Free</div>
                            <div class="col col-3 fw-bold">Premium</div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-6">
                                <p class="card-text">Stock Photos</p>
                                <p class="card-text">Stock Videos</p>
                                <p class="card-text">Stock Audios</p>
                                <p class="card-text">Premium Photo Files</p>
                                <p class="card-text">Premium Video Files</p>
                                <p class="card-text">Premium Audio Files</p>
                                <p class="card-text">Premium PSD Files</p>
                                <p class="card-text">Premium ESP Files</p>
                                <p class="card-text">Premium AEP files</p>
                            </div>
                            <div class="col col-3">
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-secondary"><i class="bi bi-x-lg"></i></p>
                                <p class="text-secondary"><i class="bi bi-x-lg"></i></p>
                                <p class="text-secondary"><i class="bi bi-x-lg"></i></p>
                                <p class="text-secondary"><i class="bi bi-x-lg"></i></p>
                                <p class="text-secondary"><i class="bi bi-x-lg"></i></p>
                                <p class="text-secondary"><i class="bi bi-x-lg"></i></p>
                            </div>
                            <div class="col col-3">
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                                <p class="text-primary"><i class="bi bi-check-lg"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-12 col-lg-6 d-none d-lg-block">
                <img src="{{ asset('dist_frontend/img/pro1.jpg') }}" alt="" class="img-fluid">
            </div>

            {{-- <div class="col col-12 col-md-6 col-lg-6 pt-4 pt-md-0 pt-lg-0">
                <div class="card justify-content-center shadow">
                    <h5 class="card-header">Choose Plan</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <select class="form-select" aria-label="Default select example" id="subscribe"
                                        name="subscribe" onchange="subscribe()">
                                        <option>Pilihan Subscribe</option>
                                        <option value="1">Tahunan</option>
                                        <option value="2">Bulanan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="psubscribe" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <p>Pajak (10%)</p>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="pajak" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer px-auto">
                        <div class="row">
                            <div class="col">
                                <p>Total</p>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="total" readonly>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mt-3  ">
                            <div class="col col-12 col-lg-6">
                                <a href="" class="btn btn-success form-control py-2" data-bs-toggle="modal"
                                    id="konfirmasi" onclick="test()">Konfirmasi</a>
                            </div>
                            <div class="col col-12">
                                <p class="my-2">Langganan Anda akan diperpanjang secara otomatis setiap bulan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row d-flex justify-content-center">
            @foreach ($price as $item)
                <div class="col col-12 col-md-6 col-lg-3 text-center my-auto d-flex justify-content-center mt-3">
                    <div class="card text-center" style="max-width: 20rem">
                        <div class="card-header fw-bold text-light fs-5 bg-black-custom">
                            {{ $item->name }}
                        </div>
                        <div class="card-body">
                            <p class="fs-3 fw-bold text-yellow">Rp. {{ $item->price }}</p>
                            {{-- {{ dd($item->price) }} --}}
                            <p class="card-text">Tingkatkan akun Anda ke versi Premium dan nikmati keuntungannya.</p>
                            <a href="{{ route('choice', ['name' => Auth::user()->name, 'price' => $item->price]) }}"
                                class="btn btn-sm bg-yellow btn-warning text-light">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- <div class="" style="height: 32vh"></div>

    <div class="modal fade" id="bayar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Metode Pembayaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <div class="row">
                            <div class="col col-1 d-flex align-self-center">
                                <input class="form-check-input" type="radio" name="pembayaran" value="789"
                                    id="flexRadioDefault2">
                            </div>
                            <div class="col col-6">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <img src="{{ asset('dist_frontend/img/BRI.svg') }}" alt="">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <div class="row">
                            <div class="col col-1 d-flex align-self-center">
                                <input class="form-check-input" type="radio" name="pembayaran" value="901"
                                    id="flexRadioDefault2">
                            </div>
                            <div class="col col-6">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <img src="{{ asset('dist_frontend/img/BNI.svg') }}" alt="">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <div class="row">
                            <div class="col col-1 d-flex align-self-center">
                                <input class="form-check-input d-flex align-item-center" type="radio" name="pembayaran"
                                    value="234" id="flexRadioDefault2">
                            </div>
                            <div class="col col-6">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <img src="{{ asset('dist_frontend/img/mandiri.svg') }}" alt=""
                                        class="img-fluid">
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" data-bs-toggle="modal" onclick="getValue()">Confirm
                        and
                        Pay</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="konBayar" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">
                        <span class="text-success fs-4"><i class="bi bi-emoji-laughing-fill"></i></span>
                        Konfirmasi
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nomor Virtual Account</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="virtual" id="virtual" value="" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Total Harga</label>
                        <input class="form-control form-control-md" type="text" aria-label=".form-control-lg example"
                            name="total" id="total2" value="" readonly>
                    </div>

                    <p>Batas Akhir Pembayaran 2 jam setelah Nomor Virtual Account diberikan!!</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('update_premium', Auth::user()->name) }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-success px-auto" value="Konfirmasi">
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
