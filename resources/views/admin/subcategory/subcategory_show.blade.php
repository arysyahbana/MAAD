@extends('admin.layouts.main')

@section('title', 'Show Sub Category')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sub Category</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-8">
                        <div class="my-3">
                            <a href="{{ route('admin_subCategory_create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus fa-cog"></i> Add Sub Category</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name</th>
                                        <th>Sub Category Order</th>
                                        <th>Show On Menu</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->rCategory->name }}</td>
                                            <td>{{ $item->sub_category_name }}</td>
                                            <td>{{ $item->sub_category_order }}</td>
                                            <td>{{ $item->show_on_menu }}</td>
                                            <td>
                                                <a href="{{ route('admin_subCategory_edit', $item->id) }}"
                                                    class="btn btn-success"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="{{ route('admin_subCategory_delete', $item->id) }}"
                                                    class="btn btn-danger" onclick="return confirm('are you sure?')"><i
                                                        class="fa fa-edit"></i>
                                                    Delete</a>

                                                {{-- <form action="{{ route('admin_category_delete', $category->id) }}"
                                                    method="get">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger"><i class="fas fa-trash"></i>
                                                        Delete</button>
                                                </form> --}}
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
