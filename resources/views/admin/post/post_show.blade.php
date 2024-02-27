@extends('admin.layouts.main')

@section('title', 'Post Show')

@section('main_content')
    <div class="container-fluid bg-light">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Post</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-12">
                        <div class="table-responsive">
                            {{-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Name</th>
                                        <th>Username</th>
                                        <th>Postname</th>
                                        <th>Post</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        @php
                                            $path_photo = asset('storage/uploads/photo/compress/' . $post->file);
                                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                                            $path_video = $post->file;
                                            $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                                            $path_audio = asset('storage/uploads/audio/' . $post->file);
                                            $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                                            $path_gd = $post->urlgd;

                                            $path_yt = $post->url;

                                        @endphp

                                        @if ($post->category_id == 3)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        <img src="{{ $path_photo }}" alt="" class="img-fluid">
                                                    @endif
                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" width="640" height="480"
                                                            allow="autoplay"></iframe>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin-post-delete', $post->slug) }}"
                                                        class="btn btn-sm btn-danger" onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-edit"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @elseif ($post->category_id == 4)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        <video class="object-fit-contain rounded-4" controls
                                                            style="max-height:52rem;">
                                                            @if ($extvideo == 'mp4')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/mp4">
                                                            @endif
                                                            @if ($extvideo == 'mkv')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/mkv">
                                                            @endif
                                                            @if ($extvideo == 'webm')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/webm">
                                                            @endif
                                                        </video>
                                                    @endif

                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" width="640" height="480"
                                                            allow="autoplay"></iframe>
                                                    @endif

                                                    @if ($post->url)
                                                        <x-embed url="{{ $post->url }}" aspect-ratio="4:3" />
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin-post-delete', $post->name) }}"
                                                        class="btn btn-danger" onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-edit"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @elseif ($post->category_id == 5)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        @if ($extaudio == 'mp3')
                                                            <audio src="{{ $path_audio }}" type="audio/mp3"
                                                                controls></audio>
                                                        @endif
                                                        @if ($extaudio == 'm4a')
                                                            <audio src="{{ $path_audio }}" type="audio/m4a"
                                                                controls></audio>
                                                        @endif
                                                    @endif

                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" width="640" height="480"
                                                            allow="autoplay"></iframe>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin-post-delete', $post->name) }}"
                                                        class="btn btn-danger" onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-edit"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table> --}}

                            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="bg-success text-light">
                                        <th scope="col">No</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Nama User</th>
                                        <th scope="col">Nama Post</th>
                                        <th scope="col">Postingan</th>
                                        <th scope="col">Postingan Project</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        @php
                                            $path_photo = asset('storage/uploads/photo/compress/' . $post->file);
                                            $extphoto = pathinfo($path_photo, PATHINFO_EXTENSION);

                                            $path_video = $post->file;
                                            $extvideo = pathinfo($path_video, PATHINFO_EXTENSION);

                                            $path_audio = asset('storage/uploads/audio/' . $post->file);
                                            $extaudio = pathinfo($path_audio, PATHINFO_EXTENSION);

                                            $path_gd = $post->urlgd;

                                            $path_yt = $post->url;

                                        @endphp

                                        @if ($post->category_id == 3)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        <img src="{{ $path_photo }}" alt="" class="img-fluid"
                                                            style="max-height:12rem;">
                                                    @endif
                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" style="max-height:12rem;"
                                                            allow="autoplay"></iframe>
                                                    @endif
                                                </td>
                                                <td>{{ $post->file_mentah }}</td>

                                                <td>
                                                    <a href="{{ route('admin-post-delete', $post->slug) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-trash-alt"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @elseif ($post->category_id == 4)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        <video class="object-fit-contain rounded-4" controls
                                                            style="max-height:12rem;">
                                                            @if ($extvideo == 'mp4')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/mp4">
                                                            @endif
                                                            @if ($extvideo == 'mkv')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/mkv">
                                                            @endif
                                                            @if ($extvideo == 'webm')
                                                                <source src="{{ $path_video }}" alt=""
                                                                    type="video/webm">
                                                            @endif
                                                        </video>
                                                    @endif

                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" allow="autoplay"
                                                            style="max-height:12rem;"></iframe>
                                                    @endif

                                                    @if ($post->url)
                                                        <x-embed url="{{ $post->url }}" style="max-height:12rem;" />
                                                    @endif
                                                </td>
                                                <td>{{ $post->file_mentah }}</td>
                                                <td>
                                                    <a href="{{ route('admin-post-delete', $post->slug) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-trash-alt"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @elseif ($post->category_id == 5)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $post->rCategory->name }}</td>
                                                <td>{{ $post->rUser->name }}</td>
                                                <td>{{ $post->name }}</td>
                                                <td>
                                                    @if ($post->file)
                                                        @if ($extaudio == 'mp3')
                                                            <audio src="{{ $path_audio }}" type="audio/mp3"
                                                                controls></audio>
                                                        @endif
                                                        @if ($extaudio == 'm4a')
                                                            <audio src="{{ $path_audio }}" type="audio/m4a"
                                                                controls></audio>
                                                        @endif
                                                    @endif

                                                    @if ($post->urlgd)
                                                        <iframe src="{{ $path_gd }}" style="max-height:12rem;"
                                                            allow="autoplay"></iframe>
                                                    @endif
                                                </td>
                                                <td>{{ $post->file_mentah }}</td>
                                                <td>
                                                    <a href="{{ route('admin-post-delete', $post->slug) }}"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('are you sure?')"><i
                                                            class="fa fa-trash-alt"></i>
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @endif
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
