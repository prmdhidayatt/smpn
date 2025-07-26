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
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-info mr-2 mb-3">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                @if (Auth::user()->role_user == 'admin')
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>

                    <div class="modal fade" id="modal-add">
                        <div class="modal-dialog">
                            <div class="modal-content custom-modal-bg">
                                <form action="{{ route('jenis_pelanggaran.store') }}" method="POST">
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
                                                <label>Nama Pelanggaran</label>
                                                <input type="text" class="form-control" name="nama_pelanggaran"
                                                    maxlength="100" placeholder="Masukkan nama pelanggaran" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <label>Kategori</label>
                                                <select class="form-control" name="kategori" required>
                                                    <option value="" disabled selected>Pilih Kategori</option>
                                                    <option value="ringan">Ringan</option>
                                                    <option value="sedang">Sedang</option>
                                                    <option value="berat">Berat</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label>Poin</label>
                                                <input type="number" class="form-control" name="poin"
                                                    placeholder="Masukkan bobot poin" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label>Sanksi pelanggaran</label>
                                                <textarea class="form-control" name="sanksi" placeholder="masukkan sanksi pelanggaran" required></textarea>
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

                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Pelanggaran</th>
                                            <th>Kategori</th>
                                            <th>Poin</th>
                                            <th>Sanksi</th>
                                            @if (Auth::user()->role_user == 'admin')
                                                <th>Opsi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jenisPelanggaran as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_pelanggaran }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->poin }}</td>
                                                <td>{{ $item->sanksi }}</td>
                                                @if (Auth::user()->role_user == 'admin')
                                                    <td>

                                                        <a href="#" class="btn btn-xs btn-warning mr-2"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit-{{ $item->id_jenispelanggaran }}">
                                                            <i class="fas fa-edit"> Edit</i>
                                                        </a>
                                                        <form
                                                            action="{{ route('jenis_pelanggaran.destroy', $item->id_jenispelanggaran) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-xs btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin?')">
                                                                <i class="fas fa-trash"> Hapus</i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>


                                            <!-- Modal Edit -->
                                            @if (Auth::user()->role_user == 'admin')
                                                <div class="modal fade" id="modal-edit-{{ $item->id_jenispelanggaran }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content custom-modal-bg">
                                                            <form
                                                                action="{{ route('jenis_pelanggaran.update', $item->id_jenispelanggaran) }}"
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
                                                                            <label>Nama Pelanggaran</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_pelanggaran"
                                                                                value="{{ $item->nama_pelanggaran }}"
                                                                                maxlength="100" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-6">
                                                                            <label>Kategori</label>
                                                                            <select class="form-control" name="kategori"
                                                                                required>
                                                                                <option value="ringan"
                                                                                    {{ $item->kategori == 'ringan' ? 'selected' : '' }}>
                                                                                    Ringan</option>
                                                                                <option value="sedang"
                                                                                    {{ $item->kategori == 'sedang' ? 'selected' : '' }}>
                                                                                    Sedang</option>
                                                                                <option value="berat"
                                                                                    {{ $item->kategori == 'berat' ? 'selected' : '' }}>
                                                                                    Berat</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label>Poin</label>
                                                                            <input type="number" class="form-control"
                                                                                name="poin"
                                                                                value="{{ $item->poin }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-sm-12">
                                                                            <label>Sanksi</label>
                                                                            <textarea class="form-control" name="sanksi" required>{{ $item->sanksi }}</textarea>
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
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <style>
        .custom-modal-bg {
            background-color: #cff6ee;
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>
@endsection
