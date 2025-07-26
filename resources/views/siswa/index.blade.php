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
            </div>
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

        <section class="content">
            <div class="container-fluid">
                <button type="button" class="btn btn-info mb-3 mr-2" onclick="window.history.back()">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </button>
                @if (Auth::user()->role_user == 'admin')
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add">
                        <i class="fas fa-plus mr-2"></i>Tambah Siswa
                    </button>

                    <!-- Modal Add -->
                    <div class="modal fade" id="modal-add">
                        <div class="modal-dialog">
                            <div class="modal-content custom-modal-bg">
                                <form action="{{ route('siswa.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Siswa</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row form-group">
                                            {{-- <div class="col-6">
                                                <label for="nisn">NISN Siswa</label>
                                                <input type="text" name="nisn" class="form-control" id="nisn"
                                                    value="{{ old('nisn') }}" placeholder="Masukkan NISN" required>
                                            </div> --}}
                                            <div class="col-6">
                                                <label for="nisn">NISN Siswa</label>
                                                <input type="text" name="nisn"
                                                    class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                                    value="{{ old('nisn') }}" placeholder="Masukkan NISN" required>
                                                @error('nisn')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">NISN harus unik dan belum terdaftar</small>
                                            </div>
                                            <div class="col-6">
                                                <label for="jk_siswa">Jenis Kelamin</label>
                                                <select name="jk_siswa" class="form-control" id="jk_siswa" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="Laki-laki"
                                                        {{ old('jk_siswa') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                    </option>
                                                    <option value="Perempuan"
                                                        {{ old('jk_siswa') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_siswa">Nama Siswa</label>
                                            <input type="text" name="nama_siswa" class="form-control" id="nama_siswa"
                                            value="{{ old('nama_siswa') }}" placeholder="Masukkan nama siswa" required
                                            pattern="[A-Za-z\s]+" title="Nama hanya boleh huruf dan spasi"
                                            oninput="this.value = this.value.replace(/[^A-Za-z\s]/g, '')">
                                        </div>
                                        

                                        <div class="row form-group">
                                            <div class="col-12">
                                                <label for="id_kelas">Kelas</label>
                                                <select name="id_kelas" class="form-control" id="id_kelas" required>
                                                    <option value="">Pilih Kelas</option>
                                                    @foreach ($kelas as $kelasItem)
                                                        <option value="{{ $kelasItem->id_kelas }}"
                                                            {{ old('id_kelas') == $kelasItem->id_kelas ? 'selected' : '' }}>
                                                            {{ $kelasItem->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                                    <option value="">Pilih Tahun Ajaran</option>
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
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-6">
                                                <label for="alamat">Alamat</label>
                                                <input type="text" name="alamat" class="form-control" id="alamat"
                                                    value="{{ old('alamat') }}" placeholder="Masukkan alamat siswa"
                                                    required>
                                            </div>
                                            <div class="col-6">
                                                <label for="no_wa">WhatsApp Wali</label>
                                                <input type="text" name="no_wa" class="form-control" id="no_wa"
                                                    value="{{ old('no_wa') }}" placeholder="Masukkkan whatsapp wali"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_wali">Nama Wali Siswa</label>
                                            <input type="text" name="nama_wali" class="form-control" id="nama_wali"
                                                value="{{ old('nama_wali') }}" placeholder="Masukkan nama wali" required>
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
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                    {{-- {{-- <th>Alamat</th> --}}
                                    {{-- <th>Tahun Angkatan</th> --}}
                                    <th>Nama Wali</th>
                                    @if (Auth::user()->role_user == 'admin')
                                        <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nisn }}</td>
                                        <td>{{ $item->nama_siswa }}</td>
                                        <td>{{ $item->jk_siswa }}</td>
                                        <td>{{ $item->kelas->nama_kelas }}</td>
                                        {{-- {{-- <td>{{ $item->alamat }}</td> --}}
                                        {{-- <td>{{ $item->tahun_ajaran }}</td> --}}
                                        <td>{{ $item->wali->nama_wali }}</td>
                                        @if (Auth::user()->role_user == 'admin')
                                            <td>
                                                <button type="button" class="btn btn-info btn-xs mr-2"
                                                    data-toggle="modal"
                                                    data-target="#modal-detail-{{ $item->id_siswa }}"><i
                                                        class="fas fa-info-circle"></i>
                                                    Detail
                                                </button>
                                                <a href="#" class="btn btn-xs btn-warning mr-2" data-toggle="modal"
                                                    data-target="#modal-edit-{{ $item->id_siswa }}">
                                                    <i class="fas fa-edit"> Edit</i>
                                                </a>
                                                <form action="{{ route('siswa.destroy', $item->id_siswa) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger">
                                                        <i class="fas fa-trash"> Hapus</i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="modal-detail-{{ $item->id_siswa }}">
                                        <div class="modal-dialog modal-xs">
                                            <div class="modal-content custom-modal">
                                                <div class="modal-header custom-modal-header">
                                                    <h4 class="modal-title">Detail Siswa</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-unstyled">
                                                        <li><span class="label">NISN</span><span class="value">:
                                                                {{ $item->nisn }}</span></li>
                                                        <li><span class="label">Nama Siswa</span><span class="value">:
                                                                {{ $item->nama_siswa }}</span></li>
                                                        <li><span class="label">Jenis Kelamin</span><span
                                                                class="value">: {{ $item->jk_siswa }}</span></li>
                                                        <li><span class="label">Kelas</span><span class="value">:
                                                                {{ $item->kelas->nama_kelas }}</span></li>
                                                        <li><span class="label">Alamat</span><span class="value">:
                                                                {{ $item->alamat }}</span></li>
                                                        {{-- <li><span class="label">Tahun Ajaran</span><span class="value">:
                                                                {{ $item->tahun_ajaran }}</span></li> --}}
                                                        <li><span class="label">Nama Wali</span><span class="value">:
                                                                {{ $item->wali->nama_wali }}
                                                            </span></li>
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if (Auth::user()->role_user == 'admin')
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="modal-edit-{{ $item->id_siswa }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content custom-modal-bg">
                                                    <form action="{{ route('siswa.update', $item->id_siswa) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Siswa</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row form-group">
                                                                <div class="col-6">
                                                                    <label for="nisn">NISN Siswa</label>
                                                                    <input type="text" name="nisn"
                                                                        class="form-control" id="nisn"
                                                                        value="{{ old('nisn', $item->nisn) }}" required>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="jk_siswa">Jenis Kelamin</label>
                                                                    <select name="jk_siswa" class="form-control"
                                                                        id="jk_siswa" required>
                                                                        <option value="Laki-laki"
                                                                            {{ old('jk_siswa', $item->jk_siswa) == 'Laki-laki' ? 'selected' : '' }}>
                                                                            Laki-laki</option>
                                                                        <option value="Perempuan"
                                                                            {{ old('jk_siswa', $item->jk_siswa) == 'Perempuan' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_siswa">Nama Siswa</label>
                                                                <input type="text" name="nama_siswa"
                                                                    class="form-control" id="nama_siswa"
                                                                    value="{{ old('nama_siswa', $item->nama_siswa) }}"
                                                                    required>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-6">
                                                                    <label for="id_kelas">Kelas</label>
                                                                    <select name="id_kelas" class="form-control"
                                                                        id="id_kelas" required>
                                                                        @foreach ($kelas as $kelasItem)
                                                                            <option value="{{ $kelasItem->id_kelas }}"
                                                                                {{ old('id_kelas', $item->id_kelas) == $kelasItem->id_kelas ? 'selected' : '' }}>
                                                                                {{ $kelasItem->nama_kelas }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
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
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-6">
                                                                    <label for="alamat">Alamat</label>
                                                                    <input type="text" name="alamat"
                                                                        class="form-control" id="alamat"
                                                                        value="{{ old('alamat', $item->alamat) }}"
                                                                        required>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label for="no_wa">WhatsApp Wali</label>
                                                                    <input type="text" name="no_wa"
                                                                        class="form-control" id="no_wa"
                                                                        value="{{ old('no_wa', $item->wali->no_wa) }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_wali">Nama Wali Siswa</label>
                                                                <input type="text" name="nama_wali"
                                                                    class="form-control" id="nama_wali"
                                                                    value="{{ old('nama_wali', $item->wali->nama_wali) }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
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
        </section>
    </div>
    <style>
        .custom-modal-bg {
            background-color: #cff6ee;
            /* Ganti dengan warna yang Anda inginkan */
        }
    </style>
    <script>
        $(document).ready(function() {
            // Validasi NISN saat form tambah siswa
            $('#nisn').on('blur', function() {
                var nisn = $(this).val();

                if (nisn) {
                    $.ajax({
                        url: "{{ route('siswa.checkNisn') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            nisn: nisn
                        },
                        success: function(response) {
                            if (response.exists) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'NISN Sudah Digunakan',
                                    text: 'NISN yang Anda masukkan sudah terdaftar!',
                                    confirmButtonColor: '#3085d6',
                                });
                                $('#nisn').val('').focus();
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });

            // Validasi NISN saat form edit siswa
            $('[id^=modal-edit-]').on('shown.bs.modal', function() {
                var modal = $(this);
                var originalNisn = modal.find('input[name="nisn"]').val();

                modal.find('input[name="nisn"]').on('blur', function() {
                    var newNisn = $(this).val();

                    if (newNisn && newNisn !== originalNisn) {
                        $.ajax({
                            url: "{{ route('siswa.checkNisn') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                nisn: newNisn
                            },
                            success: function(response) {
                                if (response.exists) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'NISN Sudah Digunakan',
                                        text: 'NISN yang Anda masukkan sudah terdaftar!',
                                        confirmButtonColor: '#3085d6',
                                    });
                                    $(this).val(originalNisn).focus();
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
