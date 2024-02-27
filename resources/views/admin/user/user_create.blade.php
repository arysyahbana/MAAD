@extends('admin.layouts.main')

@section('title', 'Add User')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_user_store') }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Add User</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
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
