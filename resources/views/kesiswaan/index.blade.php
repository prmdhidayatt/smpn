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

        <style>
            .custom-modal {
                border: 1px solid #007bff;
                border-radius: 0.5rem;
            }

            .custom-modal-header {
                background-color: #007bff;
                color: white;
                border-bottom: 1px solid #0056b3;
            }

            .custom-modal-header .modal-title {
                margin: 0;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .list-unstyled {
                margin: 0;
                padding: 0;
            }

            .list-unstyled li {
                margin-bottom: 0.5rem;
            }

            .label {
                font-weight: bold;
            }

            .value {
                margin-left: 0.5rem;
                color: #333;
            }

            .modal-footer {
                border-top: 1px solid #007bff;
                padding: 0.75rem 1.25rem;
            }
        </style>
        <style>
            .modal-body ul {
                list-style: none;
                padding: 0;
            }

            .modal-body li {
                margin-bottom: 10px;
            }

            .modal-body .label {
                font-weight: bold;
                display: inline-block;
                width: 150px;
                /* Sesuaikan dengan lebar label Anda */
            }

            .modal-body .value {
                display: inline-block;
                margin-left: 10px;
            }
        </style>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-info mr-2 mb-3">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add">
                    <i class="fas fa-plus mr-2"></i>Tambah Kesiswaan
                </button>

                <!-- Modal Add -->
                <div class="modal fade" id="modal-add">
                    <div class="modal-dialog">
                        <div class="modal-content custom-modal-bg">
                            <form action="{{ route('kesiswaan.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah {{ $subtitle }}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Kesiswaan</label>
                                        <input type="text" class="form-control" name="nama_kesiswaan" required>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <label>NIP Kesiswaan</label>
                                            <input type="text" class="form-control" name="nip"
                                                placeholder="Masukkan nip kesiswaan" required>
                                        </div>
                                        <div class="col-6">
                                            <label>Jenis Kelamin</label>
                                            <select name="jk_kesiswaan" class="form-control" required>
                                                <option value="">Pilih jenis kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Masukkan username" required>
                                        </div>
                                        <div class="col-6">
                                            <label>Role User</label>
                                            <select name="role_user" class="form-control" required>
                                                <option value="">Pilih peran pengguna</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Masukkan kata sandi" required>
                                        </div>
                                        <div class="col-6">
                                            <label>Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="Masukkan ulang kata sandi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

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
                                            <th>NIP</th>
                                            <th>Nama Kesiswaan</th>
                                            {{-- <th>Username</th> --}}
                                            {{-- <th>Password</th> --}}
                                            {{-- <th>Role User</th> --}}
                                            <th>Jenis Kelamin</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kesiswaan as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nip }}</td>
                                                <td>{{ $item->nama_kesiswaan }}</td>
                                                {{-- <td>{{ $item->user->username }}</td> --}}
                                                {{-- <td>{{ $item->user->keyword }}</td> --}}
                                                {{-- <td>{{ $item->user->role_user }}</td> --}}
                                                <td>{{ $item->jk_kesiswaan === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-xs mr-2"
                                                        data-toggle="modal"
                                                        data-target="#modal-detail-{{ $item->id_kesiswaan }}"><i
                                                            class="fas fa-info-circle"></i>
                                                        Detail
                                                    </button>
                                                    <a href="#" class="btn btn-xs btn-warning" data-toggle="modal"
                                                        data-target="#modal-edit-{{ $item->id_kesiswaan }}">
                                                        <i class="fas fa-edit"> Edit</i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="modal-detail-{{ $item->id_kesiswaan }}">
                                                <div class="modal-dialog modal-xs">
                                                    <div class="modal-content custom-modal">
                                                        <div class="modal-header custom-modal-header">
                                                            <h4 class="modal-title">Detail {{ $subtitle }}</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-unstyled">
                                                                <li><span class="label">NIP</span><span class="value">:
                                                                        {{ $item->nip }}</span></li>
                                                                <li><span class="label">Username</span><span
                                                                        class="value">:
                                                                        {{ $item->user->username }}</span></li>
                                                                <li><span class="label">Password</span><span
                                                                        class="value">:
                                                                        {{ $item->user->keyword }}</span></li>
                                                                <li><span class="label">Role User</span><span
                                                                        class="value">:
                                                                        {{ $item->user->role_user }}</span></li>
                                                                <li><span class="label">Nama Kesiswaan</span><span
                                                                        class="value">:
                                                                        {{ $item->nama_kesiswaan }}</span></li>
                                                                <li><span class="label">Jenis Kelamin</span><span
                                                                        class="value">:
                                                                        {{ $item->jk_kesiswaan === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="modal-edit-{{ $item->id_kesiswaan }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content custom-modal-bg">
                                                        <form
                                                            action="{{ route('kesiswaan.update', $item->id_kesiswaan) }}"
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
                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" class="form-control"
                                                                        name="username"
                                                                        value="{{ $item->user->username }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password (kosongkan jika tidak ingin
                                                                        mengubah)</label>
                                                                    <input type="password" class="form-control"
                                                                        name="password">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Konfirmasi Password</label>
                                                                    <input type="password" class="form-control"
                                                                        name="password_confirmation">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Role User</label>
                                                                    <select name="role_user" class="form-control"
                                                                        required>
                                                                        <option value="admin"
                                                                            {{ $item->user->role_user === 'admin' ? 'selected' : '' }}>
                                                                            Admin</option>
                                                                        <option value="user"
                                                                            {{ $item->user->role_user === 'user' ? 'selected' : '' }}>
                                                                            User</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>NIP</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nip" value="{{ $item->nip }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama Kesiswaan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama_kesiswaan"
                                                                        value="{{ $item->nama_kesiswaan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jenis Kelamin</label>
                                                                    <select name="jk_kesiswaan" class="form-control"
                                                                        required>
                                                                        <option value="L"
                                                                            {{ $item->jk_kesiswaan === 'L' ? 'selected' : '' }}>
                                                                            Laki-laki</option>
                                                                        <option value="P"
                                                                            {{ $item->jk_kesiswaan === 'P' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
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
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
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
