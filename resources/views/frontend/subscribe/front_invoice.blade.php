@extends('frontend.layouts2.main2')
@section('title', 'MAD | Invoice')

@section('container')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col col-12 mb-5">
                <h4 class="card-title fs-4 fw-bold text-start pt-3">Invoice</h4>
            </div>
            <div class="col col-12 col-md-6 col-lg-6">

                <div class="mb-3">
                    <label for="">Nama User</label>
                    <input type="text" class="form-control" name="name" value="{{ $show->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" name="price" value="{{ $price->price }}" readonly>
                </div>
                {{-- <div class="mb-3">
                    <label for="">Berapa bulan/tahun?</label>
                    <input type="number" class="form-control" name="qty" value="{{ $order->qty }}" readonly>
                </div> --}}
                <div class="mb-3">
                    <label for="">No Hp</label>
                    <input type="number" class="form-control" name="hp" value="{{ $show->hp }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="">Total Harga</label>
                    <input type="number" class="form-control" name="total" value="{{ $order->total_price }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="">Status Pembayaran</label>
                    <input type="text" class="form-control" name="status" value="{{ $order->status }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="">Status Akun</label>
                    <input type="text" class="form-control" name="role" value="{{ $show->role }}" readonly>
                </div>
                <div class="mb-3">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-success">Kembali ke Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
