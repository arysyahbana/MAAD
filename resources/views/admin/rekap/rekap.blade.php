@extends('admin.layouts.main')

@section('title', 'Post Show')

@section('main_content')
    <div class="container-fluid bg-light">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekap Absen</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col col-lg-12">
                        <div class="my-3">
                            <form action="{{ route('admin_rekap_show') }}" method="GET" class="form-inline">
                                @csrf
                                <div class="form-group mx-sm-3 mb-2">
                                    <label for="tahun_masuk" class="sr-only">Filter Tahun Masuk:</label>
                                    <select name="tahun_masuk" id="tahun_masuk" class="form-control form-control-sm">
                                        <option value="" {{ empty(request('tahun_masuk')) ? 'selected' : '' }}>Semua
                                        </option>
                                        @foreach ($distinctYears as $year)
                                            <option value="{{ $year }}"
                                                {{ request('tahun_masuk') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="fas fa-filter"></i>
                                    Filter</button>

                                <!-- Tambahkan tombol unduh Excel di sini -->
                                @if (!empty(request('tahun_masuk')))
                                    <a href="{{ route('admin_rekap_show', ['tahun_masuk' => request('tahun_masuk'), 'export_excel' => 1]) }}"
                                        class="btn btn-sm btn-success mb-2 ml-2">
                                        <i class="fas fa-download"></i> Unduh Excel
                                    </a>
                                @else
                                    <a href="{{ route('admin_rekap_show', ['export_excel_all' => 1]) }}"
                                        class="btn btn-sm btn-success mb-2 ml-2">
                                        <i class="fas fa-download"></i> Unduh Semua Excel
                                    </a>
                                @endif
                            </form>
                        </div>
                        {{-- <div class="my-3">
                            <a href="{{ route('admin_user_create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus fa-cog"></i> Add User</a>
                        </div> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center bg-success text-light">
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>NIM</th>
                                        <th>Tahun Masuk</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Skill</th>
                                        <th>Status</th>
                                        <th>Tempat Bekerja</th>
                                        <th>Kontrak Sampai Tanggal</th>
                                        <th>No HP</th>
                                        <th>Instagram</th>
                                        <th>Twitter</th>
                                        <th>Total Postingan</th>
                                        <th>Postingan Photo</th>
                                        <th>Postingan Video</th>
                                        <th>Postingan Audio</th>
                                        <th>Status Akun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userPost as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->nim }}</td>
                                            <td>{{ $item->formatted_nim }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->skill }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->place }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->contract)->format('d F Y') }}</td>
                                            <td>{{ $item->hp }}</td>
                                            <td>{{ $item->instagram }}</td>
                                            <td>{{ $item->twitter }}</td>
                                            <td>{{ $item->post_count }}</td>
                                            <td>{{ $item->photo_count }}</td>
                                            <td>{{ $item->video_count }}</td>
                                            <td>{{ $item->audio_count }}</td>
                                            <td>{{ $item->role }}</td>
                                            {{-- <td>{{ $item->role }}
                                                @if ($item->role == 'pending')
                                                    <a href="{{ route('admin_make_premium', $item->name) }}"
                                                        class="btn btn-warning mx-3">Make Premium</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_user_edit', $item->name) }}"
                                                    class="btn btn-success"><i class="fa fa-edit"></i>
                                                    Edit</a>
                                                <a href="{{ route('admin_user_delete', $item->name) }}"
                                                    class="btn btn-danger" onclick="return confirm('are you sure?')"><i
                                                        class="fa fa-edit"></i>
                                                    Delete</a>
                                            </td> --}}
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
