@extends('frontend.layouts2.main2')
@section('title', 'MAD | Pay')

@section('container')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col col-12 mb-5">
                <h4 class="card-title fs-4 fw-bold text-start pt-3">Order Detail</h4>
            </div>
            <div class="col col-12 col-md-6 col-lg-6">

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
                    <input type="number" class="form-control" name="qty" value="{{ $order->qty }}">
                </div> --}}
                <div class="mb-3">
                    <label for="">No Hp</label>
                    <input type="number" class="form-control" name="" value="{{ $show->hp }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="">Total Harga</label>
                    <input type="number" class="form-control" name="" value="{{ $order->total_price }}" readonly>
                </div>

                <div class="mb-3">
                    <button class="btn btn-sm btn-success" id="pay-button">Bayar</button>
                </div>
            </div>
            <div class="col col-12 col-lg-4 d-none d-lg-block">
                <img src="{{ asset('dist_frontend/img/pro.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $order->snaptoken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment success!");
                    window.location.href = '/user/invoice/{{ $order->id }}'
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection
