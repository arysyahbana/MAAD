@extends('admin.layouts.main')

@section('title', 'Edit Price')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_price_update', $edit->name) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update Price</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Price Name</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Price Name"
                            name="priceName" value="{{ $edit->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Harga</label>
                        <input type="number" class="form-control" id="category_name" placeholder="Price" name="price"
                            value="{{ $edit->price }}">
                    </div>
                    <div class="my-3">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="" style="height: 35.5rem"></div>
@endsection
