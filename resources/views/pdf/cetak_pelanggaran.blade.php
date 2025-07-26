<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Kasus Pelanggaran</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <style>
        .invoice-info dt {
            font-weight: bold;
        }

        .invoice-info dd {
            margin-left: 0;
            padding-left: 20px;
            /* Atur jarak antara dt dan dd */
        }
    </style>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }

        html,
        body {
            width: 210mm;
            height: 297mm;
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", Times, serif;
            background: white;
            box-sizing: border-box;
        }

        body {
            padding: 10px 20px;
            /* sedikit dikurangi agar tidak terpotong */
            font-size: 13px;
            line-height: 1.4;
        }

        .text-justify {
            text-align: justify;
        }

        .well {
            padding: 6px;
            border-radius: 4px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            margin-top: 8px;
            font-size: 13px;
        }

        .signature {
            margin-top: 20px;
            text-align: center;
        }

        .signature .date,
        .signature .title {
            margin-bottom: 3px;
            font-size: 13px;
        }

        .signature .name {
            margin-top: 20px;
            font-weight: bold;
            text-decoration: underline;
            font-size: 13px;
        }

        .qr-container {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        img {
            max-width: 100%;
        }

        /* Agar tidak terpotong saat print */
        @media print {
            * {
                page-break-inside: avoid !important;
            }

            html,
            body {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            table,
            tr,
            td,
            th,
            .row,
            section.invoice {
                page-break-inside: avoid !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>




</head>
<div style="text-align: center; line-height: 1.4;">
    <img src="{{ asset('templates') }}/dist/img/probolinggo.png" style="float: left; height: 100px; width: 85px;" />
    <img src="{{ asset('templates') }}/dist/img/remove.png" style="float: right; height: 100px; width: 100px;" />

    <p style="margin: 0; font-size: 18px; font-family: 'Times New Roman', Times, serif;">
        PEMERINTAH KABUPATEN PROBOLINGGO
    </p>
    <p style="margin: 0; font-size: 20px; font-family: 'Times New Roman', Times, serif;">
        DINAS PENDIDIKAN DAN KEBUDAYAAN
    </p>
    <p style="margin: 0; font-size: 25px; font-weight: bold; font-family: 'Times New Roman', Times, serif;">
        SMP NEGERI 1 KREJENGAN
    </p>
    <p style="margin: 0; font-size: 14px; font-family: 'Times New Roman', Times, serif;">
        Jl. Raya 344 Krejengan Telp (0335) 840145 KodePos 67284
    </p>
    <p style="margin: 0; font-size: 14px; font-family: 'Times New Roman', Times, serif;">
        Website: smpn1krejengan.sch.id | Email: smpn1krejengan.44@gmail.com
    </p>
</div>

<hr style="border: 3px solid black; margin-top: 10px; margin-bottom: 2px;">
{{-- <hr style="border: 1px solid black; margin-top: 0; margin-bottom: 20px;"> --}}



{{-- <hr style="border: 1px groove #000000; margin-top: -10px" />
<hr style="border: 2px groove #000000; margin-top: -5px" /> --}}

<body>

    {{-- <hr style="border: 1px groove #000000; margin-top: -10px" />
<hr style="border: 2px groove #000000; margin-top: -5px" /> --}}

    <!-- Judul Surat -->
    <!-- Judul Surat -->
    <p
        style="text-align: center; font-weight: bold; font-size: 19px; font-family: 'Times New Roman', Times, serif; text-transform: uppercase; margin-bottom: 5px; text-decoration: ">
        SURAT PANGGILAN ORANG TUA
    </p>

    <!-- Nomor Surat -->
    <p style="text-align: center; font-size: 16px; font-family: 'Times New Roman', Times, serif; margin-bottom: 30px;">
        No: 400.311/____/426.101/415.3.1/2025
    </p>




    <div class="wrapper">
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    {{-- <h2 class="page-header"> --}}
                    {{-- <h5 class="float-right" style="font-size: 10px">Tanggal:
                        {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}</h5> --}}

                    {{-- </h2>
                </div> --}}
                    <!-- /.col -->
                </div>
            </div>

            <body>

                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <dl class="row">
                            <dt class="col-sm-4">NISN</dt>
                            <dd class="col-sm-8">: {{ $kasus->siswa->nisn }}</dd>
                            <dt class="col-sm-4">Nama Siswa</dt>
                            <dd class="col-sm-8">: {{ $kasus->siswa->nama_siswa }}</dd>
                            <dt class="col-sm-4">Kelas</dt>
                            <dd class="col-sm-8">: {{ $namaKelas }}</dd>
                            <dt class="col-sm-4">Tahun</dt>
                            <dd class="col-sm-8">: {{ $kasus->tahun_ajaran }}</dd>
                            {{-- <dt class="col-sm-4">Total Poin</dt>
                        <dd class="col-sm-8">: {{ $totalPoin }} Poin</dd> --}}
                        </dl>
                    </div>
                    <!-- /.col -->
                </div>
                <p class="lead" style="font-weight: bold">Detail Pelanggaran :</p>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Kategori</th>
                                    <th>Poin</th>
                                    <th>Tanggal</th>
                                    <th>Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kasus->details as $detail)
                                    <tr>
                                        <td>{{ $detail->jenis_pelanggaran->nama_pelanggaran }}</td>
                                        <td>{{ $detail->jenis_pelanggaran->kategori }}</td>
                                        <td>{{ $detail->jenis_pelanggaran->poin }}</td>
                                        <td>{{ \Carbon\Carbon::parse($kasus->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $kasus->user->username }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-4">
                        <p class="lead" style="font-weight: bold">Detail Lengkap :</p>

                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Total Kasus</th>
                                    <td>: {{ $kasus->details->count() }} Pelanggaran</td>
                                </tr>
                                <tr>
                                    <th>Total Poin</th>
                                    <td>: {{ $totalPoin }} Poin</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="col-8">
                        <p class="lead"
                            style="font-weight: bold; font-family: 'Times New Roman', Times, serif; font-size: 25px;">
                            Catatan:
                        </p>
                        <p class="well text-justify well-sm shadow-none" style="margin-top: 10px;">
                            Demikian yang dapat kami informasikan mengenai beberapa pelanggaran yang telah dilakukan
                            oleh
                            putra/putri Bapak/Ibu selama periode {{ $kasus->tahun_ajaran }}. Kami berharap agar
                            Bapak/Ibu dapat bekerja sama dengan pihak
                            sekolah untuk memberikan bimbingan dan arahan kepada putra/putri Bapak/Ibu, kami juga
                            berharap kehadiran bapak/ibu di sekolah, agar pelanggaran
                            serupa tidak terulang di masa mendatang.
                        </p>
                    </div>


                    <!-- /.col -->

                </div>
                <br />
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3 text-center">
                        <p class="date">Krejengan,
                            {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->translatedFormat('d F Y') }}
                        </p>
                        <div style="margin-top: 1px;">
                            <p class="title">Mengetahui,</p>
                            <p class="title">Kepala Sekolah,</p>
                            <img src="{{ asset('templates/dist/img/barcodekepalasekolah.png') }}" width="100"
                                alt="QR Code Validasi">
                            <p class="name" style="margin-top: 1px;">Sugito, S.Pd</p>
                        </div>
                    </div>
                </div>

        </section>
    </div>
</body>
<script>
    window.addEventListener("load", window.print());
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fungsi untuk mengonversi halaman ke PDF
        function convertToPDF() {
            var element = document.body; // Atur elemen yang ingin diubah menjadi PDF
            var opt = {
                margin: [0, 0, 0, 0], // Margin: atas, kanan, bawah, kiri
                filename: 'laporan-kasus-pelanggaran.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            html2pdf().set(opt).from(element).save();
        }

        // Menambahkan tombol untuk menyimpan PDF
        var btnSavePDF = document.createElement('button');
        btnSavePDF.textContent = 'Save as PDF';
        btnSavePDF.style.position = 'fixed';
        btnSavePDF.style.bottom = '20px';
        btnSavePDF.style.right = '20px';
        btnSavePDF.style.padding = '10px';
        btnSavePDF.style.backgroundColor = '#007bff';
        btnSavePDF.style.color = '#fff';
        btnSavePDF.style.border = 'none';
        btnSavePDF.style.borderRadius = '5px';
        btnSavePDF.style.cursor = 'pointer';
        btnSavePDF.onclick = convertToPDF;
        document.body.appendChild(btnSavePDF);
    });
</script>


</html>
