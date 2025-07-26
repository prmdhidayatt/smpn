<!DOCTYPE html>
<html>

<head>
    <title>Detail Kasus Pelanggaran</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .invoice-info {
            margin-bottom: 20px;
        }

        .invoice-col dl {
            margin: 0;
        }

        .invoice-col dt {
            font-weight: bold;
            width: 100px;
            float: left;
            clear: left;
        }

        .invoice-col dd {
            margin-left: 120px;
            margin-bottom: 10px;
            clear: right;
        }
    </style>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 30px;
            margin-left: 30px;
        }

        img.hidden {
            visibility: hidden;
        }

        .text-center {
            text-align: center;
        }

        //TTd
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } */
        .signature {
            text-align: left;
            margin-top: 50px;
        }

        .signature .date {
            margin-top: 0;
        }

        .signature .title {
            margin-top: 10px;
            /* Adjust as needed */
        }

        .signature .name {
            margin-top: 80px;
            /* Adjust as needed */
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
    <style>
        .well {
            padding: 10px;
            border-radius: 5px;
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
        }

        .text-muted {
            color: #34373a;
        }

        .text-justify {
            text-align: justify;
        }
    </style>

</head>

<hr class="hr-1" />
<hr class="hr-2" />

<body>
    <h1 class="text-center">SMP 1 Krejengan</h1>
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <dl class="row">
                <dt class="col-sm-4">NISN</dt>
                <dd class="col-sm-8">: {{ $kasus->siswa->nisn }}</dd>
                <dt class="col-sm-4">Nama Siswa</dt>
                <dd class="col-sm-8">: {{ $kasus->siswa->nama_siswa }}</dd>
                <dt class="col-sm-4">Tahun</dt>
                <dd class="col-sm-8">: {{ $kasus->tahun_ajaran }}</dd>
                <dt class="col-sm-4">Total Poin</dt>
                <dd class="col-sm-8">: {{ $totalPoin }} Poin</dd>
                <dt class="col-sm-4">No. Hp</dt>
                <dd class="col-sm-8">: {{ $ortu->no_wa }}</dd>
            </dl>
        </div>
        <!-- /.col -->
    </div>

    <h3>Detail Pelanggaran</h3>
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jenis Pelanggaran</th>
                        <th>Kategori</th>
                        <th>Poin</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kasus->details as $detail)
                        <tr>
                            <td>{{ $detail->jenis_pelanggaran->nama_pelanggaran }}</td>
                            <td>{{ $detail->jenis_pelanggaran->kategori }}</td>
                            <td>{{ $detail->jenis_pelanggaran->poin }}</td>
                            <td>{{ \Carbon\Carbon::parse($kasus->tanggal)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">Catatan:</p>
            <p class="text-muted well text-justify well-sm shadow-none" style="margin-top: 10px;">
                Demikian yang dapat kami informasikan mengenai beberapa pelanggaran yang telah dilakukan oleh
                putra/putri Bapak/Ibu
                selama periode {{ $kasus->tahun_ajaran }}. Kami berharap agar Bapak/Ibu dapat bekerja sama dengan pihak
                sekolah untuk memberikan bimbingan dan arahan kepada putra/putri Bapak/Ibu, agar pelanggaran
                serupa tidak terulang di masa mendatang.
            </p>
        </div>
        <!-- /.col -->
    </div>
</b>
    <div class="row">
        <div class="signature">
            <p class="date">Krejengan, {{ $date }}</p>
            <p class="title">Wali Kelas</p>

            <p class="name">Nama Wali Kelas</p>
        </div>
    </div>
</body>

</html>
