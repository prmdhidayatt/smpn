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

                @if (Auth::user()->role_user == 'admin')
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-user-plus mr-2"></i>Tambah Wali Kelas
                    </button>

                    <!-- Modal Add -->
                    <div class="modal fade" id="modal-add">
                        <div class="modal-dialog">
                            <div class="modal-content custom-modal-bg">
                                <form action="{{ route('walikelas.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah {{ $subtitle }}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            <div class="col-sm-6">
                                                <label>NIP Wali Kelas</label>
                                                <input type="text" class="form-control" name="nip_walikelas"
                                                    maxlength="20" placeholder="Masukkan NIP" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Jenis Kelamin</label>
                                                <select name="jk_walikelas" class="custom-select" required>
                                                    <option value="">Pilih jenis kelamin</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label>Nama Wali Kelas</label>
                                                <input type="text" class="form-control" name="nama_walikelas"
                                                    maxlength="50" placeholder="Masukkan nama" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-12">
                                                <label>Jabatan Di Sekolah</label>
                                                <input type="text" class="form-control" name="jabatan" maxlength="30"
                                                    placeholder="Masukkan jabatan wali kelas" required>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                                    <?php
                                                    // Mendapatkan tahun saat ini
                                                    $tahun_sekarang = date('Y');

                                                    // Menentukan bulan awal tahun ajaran
                                                    $bulan_awal = 7; // Juli

                                                    // Menampilkan tahun ajaran untuk 5 tahun terakhir
                                                    for ($i = 5; $i > 0; $i--) {
                                                        $tahun_ajaran_awal = $tahun_sekarang - $i;
                                                        $tahun_ajaran_akhir = $tahun_ajaran_awal + 1;

                                                        // Mengatur tahun ajaran jika bulan saat ini kurang dari bulan awal tahun ajaran
                                                        if (date('n') < $bulan_awal) {
                                                            $tahun_ajaran_awal--;
                                                            $tahun_ajaran_akhir--;
                                                        }

                                                        // Menampilkan opsi untuk tahun ajaran sebelumnya
                                                        echo '<option value="' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '">' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '</option>';
                                                    }

                                                    // Menampilkan tahun ajaran untuk tahun ajaran saat ini
                                                    $tahun_ajaran_awal_sekarang = $tahun_sekarang;
                                                    $tahun_ajaran_akhir_sekarang = $tahun_ajaran_awal_sekarang + 1;
                                                    if (date('n') < $bulan_awal) {
                                                        $tahun_ajaran_awal_sekarang--;
                                                        $tahun_ajaran_akhir_sekarang--;
                                                    }
                                                    echo '<option value="' . $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang . '">' . $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang . ' (Saat Ini)</option>';

                                                    // Menampilkan tahun ajaran untuk 3 tahun mendatang
                                                    for ($i = 1; $i <= 3; $i++) {
                                                        $tahun_ajaran_awal = $tahun_sekarang + $i;
                                                        $tahun_ajaran_akhir = $tahun_ajaran_awal + 1;

                                                        // Mengatur tahun ajaran jika bulan saat ini kurang dari bulan awal tahun ajaran
                                                        if (date('n') < $bulan_awal) {
                                                            $tahun_ajaran_awal--;
                                                            $tahun_ajaran_akhir--;
                                                        }

                                                        // Menampilkan opsi untuk tahun ajaran mendatang
                                                        echo '<option value="' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '">' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="id_kelas">Kelas</label>
                                                <select name="id_kelas" class="form-control" id="id_kelas" required>
                                                    <option value="">
                                                        Pilih Kelas
                                                    </option>
                                                    @foreach ($kelas as $kelasItem)
                                                        <option value="{{ $kelasItem->id_kelas }}"
                                                            {{ old('id_kelas') == $kelasItem->id_kelas ? 'selected' : '' }}>
                                                            {{ $kelasItem->nama_kelas }}
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
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
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
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            {{-- <th>Jenis Kelamin</th> --}}
                                            {{-- <th>Jabatan</th> --}}
                                            <th>Tahun Ajaran</th>
                                            <th>Kelas</th>
                                            @if (Auth::user()->role_user == 'admin')
                                                <th>Opsi</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($walikelas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nip_walikelas }}</td>
                                                <td>{{ $item->nama_walikelas }}</td>
                                                {{-- <td>{{ $item->jk_walikelas }}</td> --}}
                                                {{-- <td>{{ $item->jabatan }}</td> --}}
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                <td>{{ $item->kelas->nama_kelas }}</td>
                                                @if (Auth::user()->role_user == 'admin')
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-xs mr-2"
                                                            data-toggle="modal"
                                                            data-target="#modal-detail-{{ $item->id_walikelas }}"><i
                                                                class="fas fa-info-circle"></i>
                                                            Detail
                                                        </button>
                                                        <a href="#" class="btn btn-xs btn-warning mr-2"
                                                            data-toggle="modal"
                                                            data-target="#modal-edit-{{ $item->id_walikelas }}"><i
                                                                class="fas fa-user-edit"> Edit</i></a>
                                                        <form
                                                            action="{{ route('walikelas.destroy', $item->id_walikelas) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data walikelas ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-xs btn-danger"><i
                                                                    class="fas fa-trash"> Hapus</i></button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>

                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="modal-detail-{{ $item->id_walikelas }}">
                                                <div class="modal-dialog modal-xs">
                                                    <div class="modal-content custom-modal">
                                                        <div class="modal-header custom-modal-header">
                                                            <h4 class="modal-title">Detail Wali Kelas</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-unstyled">
                                                                <li><span class="label">NIP</span> <span class="value">:
                                                                        {{ $item->nip_walikelas }}</span>
                                                                </li>
                                                                <li><span class="label">Nama</span> <span
                                                                        class="value">:
                                                                        {{ $item->nama_walikelas }}</span>
                                                                </li>
                                                                <li><span class="label">Jenis Kelamin</span> <span
                                                                        class="value">: {{ $item->jk_walikelas }}</span>
                                                                </li>
                                                                <li><span class="label">Jabatan</span> <span
                                                                        class="value">: {{ $item->jabatan }}</span></li>
                                                                <li><span class="label">Tahun Ajaran</span> <span
                                                                        class="value">: {{ $item->tahun_ajaran }}</span>
                                                                </li>
                                                                <li><span class="label">Kelas</span> <span
                                                                        class="value">:
                                                                        {{ $item->kelas->nama_kelas }}</span>
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

                                            @if (Auth::user()->role_user == 'admin')
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modal-edit-{{ $item->id_walikelas }}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content custom-modal-bg">
                                                            <form
                                                                action="{{ route('walikelas.update', $item->id_walikelas) }}"
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
                                                                        <div class="col-sm-6">
                                                                            <label>NIP Wali Kelas</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nip_walikelas" maxlength="20"
                                                                                value="{{ $item->nip_walikelas }}"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label>Jenis Kelamin</label>
                                                                            <select name="jk_walikelas"
                                                                                class="custom-select" required>
                                                                                <option value="Laki-laki"
                                                                                    @if ($item->jk_walikelas == 'Laki-laki') selected @endif>
                                                                                    Laki-laki</option>
                                                                                <option value="Perempuan"
                                                                                    @if ($item->jk_walikelas == 'Perempuan') selected @endif>
                                                                                    Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-sm-12">
                                                                            <label>Nama Wali Kelas</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_walikelas" maxlength="50"
                                                                                value="{{ $item->nama_walikelas }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-sm-12">
                                                                            <label>Jabatan Wali Kelas</label>
                                                                            <input type="text" class="form-control"
                                                                                name="jabatan" maxlength="30"
                                                                                value="{{ $item->jabatan }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row form-group">
                                                                        <div class="col-6">
                                                                            <label for="tahun_ajaran">Tahun Ajaran</label>
                                                                            <select name="tahun_ajaran" id="tahun_ajaran"
                                                                                class="form-control" required>
                                                                                <?php
                                                                                // Mendapatkan tahun saat ini
                                                                                $tahun_sekarang = date('Y');

                                                                                // Menentukan bulan awal tahun ajaran
                                                                                $bulan_awal = 7; // Juli

                                                                                // Menampilkan tahun ajaran untuk 5 tahun terakhir
                                                                                for ($i = 5; $i > 0; $i--) {
                                                                                    $tahun_ajaran_awal = $tahun_sekarang - $i;
                                                                                    $tahun_ajaran_akhir = $tahun_ajaran_awal + 1;

                                                                                    // Mengatur tahun ajaran jika bulan saat ini kurang dari bulan awal tahun ajaran
                                                                                    if (date('n') < $bulan_awal) {
                                                                                        $tahun_ajaran_awal--;
                                                                                        $tahun_ajaran_akhir--;
                                                                                    }

                                                                                    // Menampilkan opsi untuk tahun ajaran sebelumnya
                                                                                    $selected = old('tahun_ajaran', $item->tahun_ajaran) == $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir ? 'selected' : '';
                                                                                    echo '<option value="' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '" ' . $selected . '>' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '</option>';
                                                                                }

                                                                                // Menampilkan tahun ajaran untuk tahun ajaran saat ini
                                                                                $tahun_ajaran_awal_sekarang = $tahun_sekarang;
                                                                                $tahun_ajaran_akhir_sekarang = $tahun_ajaran_awal_sekarang + 1;
                                                                                if (date('n') < $bulan_awal) {
                                                                                    $tahun_ajaran_awal_sekarang--;
                                                                                    $tahun_ajaran_akhir_sekarang--;
                                                                                }
                                                                                $selected = old('tahun_ajaran', $item->tahun_ajaran) == $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang ? 'selected' : '';
                                                                                echo '<option value="' . $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang . '" ' . $selected . '>' . $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang . ' (Saat Ini)</option>';

                                                                                // Menampilkan tahun ajaran untuk 3 tahun mendatang
                                                                                for ($i = 1; $i <= 3; $i++) {
                                                                                    $tahun_ajaran_awal = $tahun_sekarang + $i;
                                                                                    $tahun_ajaran_akhir = $tahun_ajaran_awal + 1;

                                                                                    // Mengatur tahun ajaran jika bulan saat ini kurang dari bulan awal tahun ajaran
                                                                                    if (date('n') < $bulan_awal) {
                                                                                        $tahun_ajaran_awal--;
                                                                                        $tahun_ajaran_akhir--;
                                                                                    }

                                                                                    // Menampilkan opsi untuk tahun ajaran mendatang
                                                                                    $selected = old('tahun_ajaran', $item->tahun_ajaran) == $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir ? 'selected' : '';
                                                                                    echo '<option value="' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '" ' . $selected . '>' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <label for="id_kelas">Kelas</label>
                                                                            <select name="id_kelas" class="form-control"
                                                                                id="id_kelas" required>
                                                                                @foreach ($kelas as $kelasItem)
                                                                                    <option
                                                                                        value="{{ $kelasItem->id_kelas }}"
                                                                                        {{ old('id_kelas', $item->id_kelas) == $kelasItem->id_kelas ? 'selected' : '' }}>
                                                                                        {{ $kelasItem->nama_kelas }}
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
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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
