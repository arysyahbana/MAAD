@extends('frontend.layouts2.main2')

@section('title', 'MAD | Your Plan')

@section('container')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col col-12 mb-5">
                <h4 class="card-title fs-4 fw-bold text-start pt-3">Choose your plan</h4>
            </div>
            <div class="col col-12 col-md-6 col-lg-6">
                <form action="{{ route('pay', ['name' => Auth::user()->name, 'price' => $price]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="">Nama User</label>
                        <input type="text" class="form-control" name="" value="{{ $show->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="">Harga</label>
                        <input type="text" class="form-control" name="" value="{{ $price }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="">Berapa bulan/tahun?</label>
                        <input type="number" class="form-control" name="qty">
                    </div> --}}
                    <div class="mb-3">
                        <label for="">No Hp</label>
                        <input type="number" class="form-control" name="" value="{{ $show->hp }}" readonly>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-sm btn-success">Order now</button>
                    </div>
                </form>
            </div>
            <div class="col col-12 col-lg-4 d-none d-lg-block">
                <img src="{{ asset('dist_frontend/img/pro.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
