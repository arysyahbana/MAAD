@extends('admin.layouts.main')

@section('title', 'Add Price')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_price_store') }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Add Price</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Price Name</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Price Name"
                            name="priceName">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga</label>
                        <input type="number" class="form-control" id="category_name" placeholder="Price" name="price">
                    </div>
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style="height: 35.5rem"></div>
@endsection
