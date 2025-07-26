@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $subtitle }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kelas.index') }}">Kelas</a></li>
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">

                <a href="{{ route('kelas.index') }}" class="btn btn-sm btn-info mr-2 mb-3">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <form action="{{ route('kelas.naikKelas') }}" method="POST">
                            @csrf
                            @if (Auth::user()->role_user == 'admin')
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <select name="kelas_baru" class="form-control" required>
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelasList as $kelas)
                                                <option value="{{ $kelas->id_kelas }}">{{ $kelas->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-danger">Pindah Kelas</button>
                                    </div>
                                    
                                </div>
                            @endif
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @if (Auth::user()->role_user == 'admin')
                                            <th><input type="checkbox" id="select-all"></th>
                                        @endif
                                        <th>No.</th>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Nama Wali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $item)
                                        <tr>
                                            @if (Auth::user()->role_user == 'admin')
                                                <td><input type="checkbox" name="siswa_ids[]" value="{{ $item->id_siswa }}">
                                                </td>
                                            @endif
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nisn }}</td>
                                            <td>{{ $item->nama_siswa }}</td>
                                            <td>{{ $item->jk_siswa }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->tahun_ajaran }}</td>
                                            <td>{{ $item->wali->nama_wali }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if (Auth::user()->role_user == 'admin')
        <script>
            document.getElementById('select-all').addEventListener('change', function() {
                var checkboxes = document.querySelectorAll('input[name="siswa_ids[]"]');
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        </script>
    @endif

@endsection
