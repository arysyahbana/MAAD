@extends('admin.layouts.main')

@section('title', 'Edit Profile')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_profile_update', Auth::user()->nama) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update Profile Admin</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Name"
                            value="{{ $edit->nama }}" name="nama">
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="email"
                            value="{{ $edit->email }}" name="email">
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
