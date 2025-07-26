@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $subtitle }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-info mr-2 mb-3">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                @if (Auth::user()->role_user == 'admin')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mr-2 mb-3" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-plus mr-1"></i> Tambah Kelas
                    </button>
            
                    {{-- <!-- Tombol Import -->
                    <a href="{{ route('kelas.import') }}" class="btn btn-success mb-3 mr-2" target="_blank">
                        <i class="fas fa-file-upload mr-1"></i> Import Kelas
                    </a> --}}
                    

                    <!-- Modal Add -->
                    <div class="modal fade" id="modal-add">
                        <div class="modal-dialog">
                            <div class="modal-content custom-modal-bg">
                                <form action="{{ route('kelas.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah {{ $subtitle }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label>Nama Kelas</label>
                                                <input type="text" class="form-control" name="nama_kelas" maxlength="50"
                                                    placeholder="Masukkan nama kelas" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label>Tahun Ajaran</label>
                                                <select name="id_tahunajaran" class="form-control" required>
                                                    <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                                    @foreach ($tahunAjaran as $tahun)
                                                        <option value="{{ $tahun->id_tahunajaran }}">{{ $tahun->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kelas</th>
                                            <th>Jumlah Siswa</th>
                                            <th>Nama Wali Kelas</th>
                                            <th>Tahun Ajaran</th>
                                            @if (Auth::user()->role_user == 'admin')
                                                <th>Opsi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kelas }}</td>
                                                <td>{{ $item->siswas_count }} Siswa</td>
                                                <td>
                                                    @if ($item->walikelas->isNotEmpty())
                                                        @foreach ($item->walikelas as $walikelas)
                                                            {{ $walikelas->nama_walikelas }}<br>
                                                        @endforeach
                                                    @else
                                                        Belum Ada Wali Kelas
                                                    @endif
                                                </td>
                                                <td>{{ $item->tahunAjaran->nama}}</td>

                                                {{-- @if (Auth::user()->role_user == 'admin')
                                                    <td>
                                                        <!-- Actions -->
                                                    </td>
                                                @endif --}}


                                                <td>
                                                    @if (Auth::user()->role_user == 'admin')
                                                        <a href="#" class="btn btn-xs btn-warning mr-2"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit-{{ $item->id_kelas }}">
                                                            <i class="fas fa-edit"> Edit</i>
                                                        </a>
                                                

                                                
                                                        {{-- Tombol Lihat Siswa --}}
                                                        <a href="{{ route('kelas.siswa', $item->id_kelas) }}"
                                                            class="btn btn-xs btn-success">
                                                            <i class="fas fa-eye"> Lihat Siswa</i>
                                                        </a>
                                                    @endif
                                                
                                                    @if (Auth::user()->role_user == 'user')
                                                        <a href="{{ route('kelas.siswa', $item->id_kelas) }}"
                                                            class="btn btn-xs btn-success">
                                                            <i class="fas fa-eye"> Lihat Siswa</i>
                                                        </a>
                                                    @endif
                                                </td>
                                                

                                            </tr>
                                            @if (Auth::user()->role_user == 'admin')
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modal-edit-{{ $item->id_kelas }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content custom-modal-bg">
                                                            <form action="{{ route('kelas.update', $item->id_kelas) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit {{ $subtitle }}</h4>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row form-group">
                                                                        <div class="col-sm-12">
                                                                            <label>Nama Kelas</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_kelas" maxlength="50"
                                                                                value="{{ $item->nama_kelas }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-sm-12">
                                                                            <label>Tahun Ajaran</label>
                                                                            <select class="form-control"
                                                                                name="id_tahunajaran" required>
                                                                                @foreach ($tahunAjaran as $tahun)
                                                                                    <option
                                                                                        value="{{ $tahun->id_tahunajaran }}"
                                                                                        {{ $item->id_tahunajaran == $tahun->id_tahunajaran ? 'selected' : '' }}>
                                                                                        {{ $tahun->nama }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-danger"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <style>
        .custom-modal-bg {
            background-color: #cff6ee;
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>
@endsection
