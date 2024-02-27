@extends('admin.layouts.main')

@section('title', 'Admin')

@section('main_content')
    <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Welcome back to dashboard <span
                        class="text-primary font-weight-bold">{{ Auth::user()->nama }}</span></h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Mahasiswa</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countUser }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Jumlah Postingan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $post }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kategori
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $category }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Users Premium</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userPremium }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Banyak Postingan per Kategori</h6>
                            {{-- <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div> --}}
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <script>
                                    var photoCount = {!! json_encode($photoCount) !!};
                                    var videoCount = {!! json_encode($videoCount) !!};
                                    var audioCount = {!! json_encode($audioCount) !!};
                                </script>
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Photo
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Video
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Audio
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-4">
                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Top 5 Mahasiswa postingan terbanyak</h6>
                        </div>
                        <div class="card-body">
                            {{-- <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                            </div> --}}
                            <table class="table text-center">
                                <thead>
                                    <tr class="bg-info text-light">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tahun Masuk</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Skill</th>
                                        <th scope="col">Jumlah Postingan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWithPostCount as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->formatted_nim }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->skill }}</td>
                                            <td>{{ $item->post_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <!-- Approach -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Postingan Mahasiswa</h6>
                        </div>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                    <tr class="bg-success text-light">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tahun Masuk</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Skill</th>
                                        <th scope="col">Jumlah Postingan</th>
                                        <th scope="col">Jumlah Postingan Photo</th>
                                        <th scope="col">Jumlah Postingan Video</th>
                                        <th scope="col">Jumlah Postingan Audio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userPost as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->formatted_nim }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->skill }}</td>
                                            <td>{{ $item->post_count }}</td>
                                            <td>{{ $item->photo_count }}</td>
                                            <td>{{ $item->video_count }}</td>
                                            <td>{{ $item->audio_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
@endsection
