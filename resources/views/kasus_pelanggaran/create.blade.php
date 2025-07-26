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
        <div class="container">
            <form action="{{ route('kasus_pelanggaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_siswa">Nama Siswa</label>
                            <select name="id_siswa" id="id_siswa" class="form-control select2bs4" required>
                                <option value="">Pilih Siswa</option>
                                @foreach ($siswa as $s)
                                    <option value="{{ $s->id_siswa }}">{{ $s->nisn }}: {{ $s->nama_siswa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
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
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="dynamic_field" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Jenis Pelanggaran</th>
                                <th>Tanggal</th>
                                {{-- <th>Bukti</th> --}}
                                <th>Total Poin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="row1">
                                <td>
                                    <select name="details[0][jenis_pelanggaran_id]" class="form-control jenis-pelanggaran-dropdown">
                                        <option value="">Pilih Pelanggaran</option>
                                        @foreach ($jenisPelanggaran as $jp)
                                            <option value="{{ $jp->id_jenispelanggaran }}" data-poin="{{ $jp->poin }}">{{ $jp->nama_pelanggaran }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="date" name="tanggal[0]" class="form-control" /></td>
                                {{-- <td><input type="file" name="bukti[0]" class="form-control" /></td> --}}
                                <td><input type="text" name="details[0][total_poin]" class="form-control total-poin-input" readonly /></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Tambah</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-group">
                            <label for="total_poin">Total Poin</label>
                            <input type="text" class="form-control" id="total_poin" name="total_poin" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container -->
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    var i = 1;

    function calculateTotalPoints() {
        var total = 0;
        $('.total-poin-input').each(function() {
            var poin = $(this).val();
            if (poin && !isNaN(poin)) {
                total += parseInt(poin, 10);
            }
        });
        $('#total_poin').val(total);
    }

    $(document).on('change', '.jenis-pelanggaran-dropdown', function(){
        var poin = $(this).find(':selected').data('poin');
        $(this).closest('tr').find('.total-poin-input').val(poin);
        calculateTotalPoints();
    });

    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'">' +
            '<td><select name="details['+i+'][jenis_pelanggaran_id]" class="form-control jenis-pelanggaran-dropdown">' +
            '<option value="">Pilih Pelanggaran</option>' +
            '@foreach ($jenisPelanggaran as $jp)' +
            '<option value="{{ $jp->id_jenispelanggaran }}" data-poin="{{ $jp->poin }}">{{ $jp->nama_pelanggaran }}</option>' +
            '@endforeach' +
            '</select></td>' +
            '<td><input type="date" name="tanggal['+i+']" class="form-control" /></td>' +
            // '<td><input type="file" name="bukti['+i+']" class="form-control" /></td>' +
            '<td><input type="text" name="details['+i+'][total_poin]" class="form-control total-poin-input" readonly /></td>' +
            '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Hapus</button></td>' +
            '</tr>');
    });

    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $('#row'+button_id).remove();
        calculateTotalPoints();
    });
});
</script>

@endsection
