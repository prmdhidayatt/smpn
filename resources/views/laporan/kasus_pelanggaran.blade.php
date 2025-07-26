@extends('layouts.app')
<style>
    @media print {
        .modal {
            display: block !important;
        }

        .btn {
            display: none;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 5px;
        }

        .table thead {
            background-color: #f2f2f2;
        }
    }
</style>

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1>Daftar Kasus Pelanggaran </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Kasus Pelanggaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container">

                <form method="GET" action="{{ route('laporankasus_pelanggaran.index') }}">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_siswa">Nama Siswa</label>
                                <select name="nama" id="nama" class="form-control select2bs4" required>
                                    <option value="">Pilih Siswa</option>
                                    @foreach ($siswa as $s)
                                        <option value="{{ $s->id_siswa }}">{{ $s->nisn }}: {{ $s->nama_siswa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                    <?php
                                    $tahun_sekarang = date('Y');
                                    $bulan_awal = 7;
                                    for ($i = 5; $i > 0; $i--) {
                                        $tahun_ajaran_awal = $tahun_sekarang - $i;
                                        $tahun_ajaran_akhir = $tahun_ajaran_awal + 1;
                                        if (date('n') < $bulan_awal) {
                                            $tahun_ajaran_awal--;
                                            $tahun_ajaran_akhir--;
                                        }
                                        echo '<option value="' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '">' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '</option>';
                                    }
                                    $tahun_ajaran_awal_sekarang = $tahun_sekarang;
                                    $tahun_ajaran_akhir_sekarang = $tahun_ajaran_awal_sekarang + 1;
                                    if (date('n') < $bulan_awal) {
                                        $tahun_ajaran_awal_sekarang--;
                                        $tahun_ajaran_akhir_sekarang--;
                                    }
                                    echo '<option value="' . $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang . '"> ' . $tahun_ajaran_awal_sekarang . '/' . $tahun_ajaran_akhir_sekarang . ' (Saat Ini)</option>';
                                    for ($i = 1; $i <= 3; $i++) {
                                        $tahun_ajaran_awal = $tahun_sekarang + $i;
                                        $tahun_ajaran_akhir = $tahun_ajaran_awal + 1;
                                        if (date('n') < $bulan_awal) {
                                            $tahun_ajaran_awal--;
                                            $tahun_ajaran_akhir--;
                                        }
                                        echo '<option value="' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '">' . $tahun_ajaran_awal . '/' . $tahun_ajaran_akhir . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal_sampai">Pencarian</label>
                                <button type="submit" class="btn btn-primary col-8">Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.querySelector('form');
                        form.addEventListener('submit', function(e) {
                            const nama = document.getElementById('nama').value.trim();
                            const tahun = document.getElementById('tahun_ajaran').value.trim();

                            if (!nama || !tahun) {
                                alert('Silakan isi semua kolom terlebih dahulu.');
                                e.preventDefault(); // mencegah form submit
                            }
                        });
                    });
                </script>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kasus Pelanggaran</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal</th>
                                    <th>Kelas</th> <!-- Kolom kelas ditambahkan di sini -->
                                    <th>Tahun Ajaran</th>
                                    <th>Total Poin</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kasusPelanggaran as $kasus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kasus->siswa->nama_siswa ?? 'Tidak Diketahui' }}</td>
                                        <td>{{ $kasus->tanggal }}</td>
                                        <td>{{ $kasus->siswa->kelas->nama_kelas ?? '-' }}</td> <!-- Isi kelas -->
                                        <td>{{ $kasus->tahun_ajaran }}</td>
                                        <td>
                                            @php
                                                $totalPoin = $kasus->details->sum(function ($detail) {
                                                    return $detail->jenis_pelanggaran->poin;
                                                });
                                            @endphp
                                            {{ $totalPoin }}
                                        </td>
                                        <td>
                                            <!-- Tombol dan modal detail tetap -->
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                                data-target="#detailModal-{{ $kasus->id_kasus }}">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </button>

                                            <a href="{{ route('kasus.edit_wa', $kasus->id_kasus) }}"
                                                class="btn btn-success btn-xs" target="_blank">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>


                                            <a href="{{ route('cetak.plg', ['id' => $kasus->id_kasus]) }}"
                                                class="btn btn-primary btn-xs" target="_blank">
                                                <i class="fas fa-print"></i> Cetak PDF
                                            </a>

                                            <div class="modal fade" id="detailModal-{{ $kasus->id_kasus }}" tabindex="-1"
                                                role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detailModalLabel">Detail Kasus
                                                                Pelanggaran</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Jenis Pelanggaran</th>
                                                                        <th>Kategori</th>
                                                                        <th>Poin</th>
                                                                        <th>Sanksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($kasus->details as $detail)
                                                                        <tr>
                                                                            <td>{{ $detail->jenis_pelanggaran->nama_pelanggaran }}
                                                                            </td>
                                                                            <td>{{ $detail->jenis_pelanggaran->kategori }}
                                                                            </td>
                                                                            <td>{{ $detail->jenis_pelanggaran->poin }}</td>
                                                                            <td>{{ $detail->jenis_pelanggaran->sanksi }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
