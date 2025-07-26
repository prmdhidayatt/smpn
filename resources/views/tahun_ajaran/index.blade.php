@extends('layouts.app')

@section('content')
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
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal"
                    data-target="#modal-add-tahunajaran">
                    <i class="fas fa-plus mr-2"></i>Tambah Tahun Ajaran
                </button>

                <!-- Modal Add -->
                <div class="modal fade" id="modal-add-tahunajaran">
                    <div class="modal-dialog">
                        <div class="modal-content custom-modal-bg">
                            <form action="{{ route('tahunajaran.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Tahun Ajaran</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <label>Nama Tahun Ajaran</label>
                                            <input type="text" class="form-control" name="nama" maxlength="50"
                                                placeholder="Masukkan nama tahun ajaran" required>
                                        </div>
                                        <div class="col-sm-12 mt-3">
                                            <label>Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="aktif">Aktif</option>
                                                <option value="tidak aktif">Tidak Aktif</option>
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

                <!-- Table Tahun Ajaran -->
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Tahun Ajaran</th>
                                            <th>Status</th>
                                            @if (Auth::user()->role_user == 'admin')
                                                <th>Opsi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tahunajaran as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>
                                                    @if ($item->status == 'aktif')
                                                        <span class="badge badge-success">Sedang Aktif</span>
                                                    @else
                                                        <span class="badge badge-danger">Tidak Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (Auth::user()->role_user == 'admin')
                                                        <a href="#" class="btn btn-xs btn-warning mr-2"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit-tahunajaran-{{ $item->id_tahunajaran }}">
                                                            <i class="fas fa-edit"> Edit</i>
                                                        </a>

                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Modal Edit Tahun Ajaran -->
                                            <div class="modal fade" id="modal-edit-tahunajaran-{{ $item->id_tahunajaran }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content custom-modal-bg">
                                                        <form
                                                            action="{{ route('tahunajaran.update', $item->id_tahunajaran) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Tahun Ajaran</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row form-group">
                                                                    <div class="col-sm-12">
                                                                        <label>Nama Tahun Ajaran</label>
                                                                        <input type="text" class="form-control"
                                                                            name="nama" maxlength="50"
                                                                            value="{{ $item->nama }}" required>
                                                                    </div>
                                                                    <div class="col-sm-12 mt-3">
                                                                        <label>Status</label>
                                                                        <select class="form-control" name="status"
                                                                            required>
                                                                            <option value="aktif"
                                                                                {{ $item->status == 'aktif' ? 'selected' : '' }}>
                                                                                Aktif</option>
                                                                            <option value="tidak aktif"
                                                                                {{ $item->status == 'tidak aktif' ? 'selected' : '' }}>
                                                                                Tidak Aktif</option>
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
