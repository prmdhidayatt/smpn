@extends('layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
        }
    </style>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $subtitle }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $jumlahSiswa }}</h3>
                                <p>Siswa</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people"></i>
                            </div>
                            @if (Auth::user()->role_user != 'user')
                                <a href="{{ route('siswa.index') }}" class="small-box-footer"> Info Lengkap <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $jumlahKelas }}</h3>
                                <p>Kelas</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            @if (Auth::user()->role_user != 'user')
                                <a href="{{ route('kelas.index') }}" class="small-box-footer"> Info Lengkap <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $totalKesiswaan}}</h3>
                                <p>Pengguna</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            @if (Auth::user()->role_user != 'user')
                                <a href="{{ route('kesiswaan.index') }}" class="small-box-footer"> Info Lengkap <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $jenisPelanggaran }}</h3>
                                <p>Jenis Pelanggaran</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-list"></i>
                            </div>
                            @if (Auth::user()->role_user != 'user')
                                <a href="{{ route('jenis_pelanggaran.index') }}" class="small-box-footer"> Info Lengkap <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12 connectedSortable">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-list-alt"></i>
                                    Top 4 Siswa Berdasarkan Poin
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped display nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Total Poin</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($top4Siswa as $siswa)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $siswa->nama_siswa }}</td>
                                                <td>{{ $siswa->nama_kelas }}</td>
                                                <td>{{ $siswa->total_poin }}</td>
                                                <td>
                                                    @php
                                                        $totalPoin = $siswa->total_poin;
                                                
                                                        if ($totalPoin < 50) {
                                                            $status = '🟢 Status Aman';
                                                        } elseif ($totalPoin >= 50 && $totalPoin <= 60) {
                                                            $status = '🔵 Panggil Siswa';
                                                        } elseif ($totalPoin > 60 && $totalPoin <= 70) {
                                                            $status = '🟠 Panggil Orang Tua (1)';
                                                        } elseif ($totalPoin > 70 && $totalPoin <= 90) {
                                                            $status = '🟠 Panggil Orang Tua (2)';
                                                        } elseif ($totalPoin == 100) {
                                                            $status = '🔴 Dikeluarkan ';
                                                        } else {
                                                            $status = '🔴 Dikeluarkan '; // fallback untuk nilai tidak terduga
                                                        }
                                                    @endphp
                                                    {{ $status }}
                                                </td>
                                                

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4">
                        <!-- DONUT CHART -->
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fab fa-osi mr-2"></i>Kelas Terbanyak Melanggar</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-8 connectedSortable">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="far fa-list-alt"></i>
                                    Top 4 Pelanggaran
                                </h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped display nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 1%;" class="text-center">No.</th>
                                            <th scope="col" style="width: 16%;" class="text-center">Nama Pelanggaran</th>
                                            <th scope="col" class="text-center" style="width: 5%;">Total Dilanggar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($top4Pelanggaran as $index => $pelanggaran)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>{{ $pelanggaran->nama_pelanggaran }}</td>
                                                <td>{{ $pelanggaran->total_siswa }} Pelanggar</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('donutChart').getContext('2d');
            var donutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($kelasTerbanyak->pluck('nama_kelas')),
                    datasets: [{
                        data: @json($kelasTerbanyak->pluck('total_poin')),
                        backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#c9cbcf'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
