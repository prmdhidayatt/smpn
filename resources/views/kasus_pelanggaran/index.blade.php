@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kasus Pelanggaran</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Kasus Pelanggaran</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <a href="{{ route('kasus_pelanggaran.create') }}" class="btn btn-primary mb-2"> <i class="fas fa-plus mr-2"></i> Kasus
                            Pelanggaran</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Kasus Pelanggaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Siswa</th>
                                    <th>Total Point</th>
                                    <th>Tanggal</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($kasusPelanggaran as $kasus)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kasus->siswa->nama_siswa }}</td>
                                        <td>
                                            @php
                                                $totalPoin = $kasus->details->sum(function ($detail) {
                                                    return $detail->jenis_pelanggaran->poin;
                                                });
                                            @endphp
                                            {{ $totalPoin }}
                                        </td>
                                        <td>{{ $kasus->tanggal }}</td>

                                        <td>{{ $kasus->tahun_ajaran }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal"
                                                data-target="#detailModal" data-id="{{ $kasus->id_kasus }}">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </button>
                                            <form action="{{ route('kasus_pelanggaran.destroy', $kasus->id_kasus) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kasus ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-xs btn-danger"><i
                                                        class="fas fa-trash"> Hapus</i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Kasus Pelanggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="detail-content">
                        <!-- Detail will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#detailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var kasusId = button.data('id'); // Extract info from data-* attributes

                var modal = $(this);

                $.ajax({
                    url: '/kasus_pelanggaran/' + kasusId, // Route untuk mendapatkan detail kasus
                    type: 'GET',
                    success: function(data) {
                        var content = '<table class="table table-bordered">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>Jenis Pelanggaran</th>' +
                            '<th>Kategori</th>' +
                            '<th>Poin</th>' +
                            '<th>Sanksi</th>' +
                            '<th>Tanggal</th>' +
                            // '<th>Bukti</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>';

                        $.each(data.details, function(index, detail) {
                            content += '<tr>' +
                                '<td>' + detail.jenis_pelanggaran.nama_pelanggaran +
                                '</td>' +
                                '<td>' + detail.jenis_pelanggaran.kategori + '</td>' +
                                '<td>' + detail.jenis_pelanggaran.poin + '</td>' +
                                '<td>' + detail.jenis_pelanggaran.sanksi + '</td>' +
                                '<td>' + detail.jenis_pelanggaran.tanggal + '</td>' +
                                // '<td><img src="{{ asset('storage/uploads/') }}/' +
                                // detail.jenis_pelanggaran.bukti +
                                // '" style="max-width: 80px; max-height: 50px;"></td>' +
                                '</tr>';
                        });

                        content += '</tbody></table>';

                        modal.find('#detail-content').html(content);
                    },
                    error: function() {
                        modal.find('#detail-content').html(
                            '<p>Terjadi kesalahan saat memuat data.</p>');
                    }
                });
            });
        });
    </script>
@endsection
