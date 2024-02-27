@extends('admin.layouts.main')

@section('title', 'Show User')

@section('main_content')
    <div class="container-fluid bg-light">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-8">
                        <div class="my-3">
                            <a href="{{ route('admin_user_create') }}" class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus fa-cog"></i> Add User</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-primary text-light">
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role }}
                                                @if ($item->role == 'pending')
                                                    <a href="{{ route('admin_make_premium', $item->name) }}"
                                                        class="btn btn-sm btn-warning mx-3">Make Premium</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_user_edit', $item->name) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="{{ route('admin_user_delete', $item->name) }}"
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
