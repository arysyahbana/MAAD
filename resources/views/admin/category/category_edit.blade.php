@extends('admin.layouts.main')

@section('title', 'Edit Category')

@section('main_content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('admin_category_update', $edit->name) }}" method="post">
                @csrf
                <div class="card-body">
                    <h5 class="card-title">Update Category</h5>
                    <div class="mb-3">
                        <label class="form-label text-dark ">Category Name</label>
                        <input type="text" class="form-control" id="category_name" placeholder="Category Name"
                            value="{{ $edit->name }}" name="category_name">
                    </div>
                    <div class="form-group mb-3">
                        <label>Show On Menu?</label>
                        <select name="show_on_menu" class="form-control">
                            <option value="Show" @if ($edit->show_on_menu == 'Show') selected @endif>Show</option>
                            <option value="Hide" @if ($edit->show_on_menu == 'Hide') selected @endif>Hide</option>
                        </select>
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
