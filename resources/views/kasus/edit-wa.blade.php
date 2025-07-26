@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                {{-- Card --}}
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Masukan nomor orang tua siswa</h5>
                    </div>
                    <div class="card-body">

                        {{-- Notifikasi --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('kasus.update_wa', $kasus->id_kasus) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                                <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                    name="no_wa" id="no_wa" placeholder="Contoh: 6281234567890"
                                    value="{{ old('no_wa', $kasus->siswa->wali->no_wa) }}" required autofocus readonly>
                                @error('no_wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Pesan --}}
<div class="mb-3">
    <label for="pesan" class="form-label">Pesan</label>
    <textarea class="form-control @error('pesan') is-invalid @enderror" 
              name="pesan" 
              id="pesan" 
              rows="14" 
              required>{{ old('pesan',
"Assalamu'alaikum Wr. Wb.

Yth. Bapak/Ibu Wali Murid dari " . ($kasus->siswa->nama_siswa ?? 'Tidak Diketahui') . ",

Dengan ini kami informasikan bahwa putra/putri Bapak/Ibu telah melakukan pelanggaran terhadap tata tertib sekolah dengan rincian sebagai berikut:

📅 *Tanggal:* " . ($kasus->tanggal ? \Carbon\Carbon::parse($kasus->tanggal)->format('d-m-Y') : 'Tanggal Pelanggaran') . "
🚫 *Jenis Pelanggaran:* " . ($kasus->details->pluck('jenis_pelanggaran.nama_pelanggaran')->implode(', ') ?? 'Tidak ada data pelanggaran') . "
⭐ *Total Poin:* " . ($kasus->details->sum('jenis_pelanggaran.poin') ?? 0) . "

Sehubungan dengan hal tersebut, kami mohon kerja sama Bapak/Ibu untuk:
1. Memberikan pembinaan lanjutan di rumah
2. Memantau perkembangan putra/putri
3. Berkomunikasi dengan wali kelas

Demikian pemberitahuan ini kami sampaikan. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.

Wassalamu'alaikum Wr. Wb.

Hormat kami,
*SMPN 1 Krejengan*
📞 (0335)8401445
🏫 SMP Negeri 1 Krejengan Kecamatan Krejengan PROBOLINGGO - JAWA TIMUR (Samping Lapangan Krejengan) Jalan Raya No.344 Krejengan Kode POS 67284"
    ) }}</textarea>
    @error('pesan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>


                            {{-- Tombol --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('laporankasus_pelanggaran.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Fokus otomatis --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('no_wa').focus();
        });
    </script>
@endsection
