@extends('admin.layouts.main')

@section('title', 'Show Price')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Price</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-8">
                        <div class="my-3">
                            <a href="{{ route('admin_price_create') }}" class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus fa-cog"></i> Add Price</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>No</th>
                                        <th>Price Name</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($price as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                <a href="{{ route('admin_price_edit', $item->name) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="{{ route('admin_price_delete', $item->name) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('are you sure?')"><i
                                                        class="fa fa-trash-alt"></i>
                                                    Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
