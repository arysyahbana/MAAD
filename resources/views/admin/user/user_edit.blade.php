@extends('admin.layouts.main')

@section('title', 'Edit User')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_user_update', $edit->name) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update User</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name"
                            value="{{ $edit->name }}" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="email"
                            value="{{ $edit->email }}" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label>Status Akun</label>
                        <select name="role" class="form-control" value="{{ $edit->role }}">
                            <option>premium</option>
                            <option>umum</option>
                            <option>pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">New Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Retype Password</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Retype Password"
                            name="password_confirmation">
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
