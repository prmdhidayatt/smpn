<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasusPelanggaran;
use App\Models\Siswa;
use Carbon\Carbon;

class LaporanKasusPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        // Query untuk kasus pelanggaran
        $query = KasusPelanggaran::query();

        $siswa = Siswa::all();
        // Pencarian berdasarkan nama siswa
        if ($request->has('nama')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('id_siswa', 'like', '%' . $request->nama . '%');
            });
        }

        // Pencarian berdasarkan tahun ajaran
        if ($request->has('tahun_ajaran')) {
            $query->where('tahun_ajaran', $request->input('tahun_ajaran'));
        }

        // Pencarian berdasarkan rentang tanggal
        if ($request->has('tanggal_mulai') && $request->has('tanggal_sampai')) {
            $tanggalMulai = Carbon::parse($request->input('tanggal_mulai'))->startOfDay();
            $tanggalSampai = Carbon::parse($request->input('tanggal_sampai'))->endOfDay();
            $query->whereBetween('tanggal', [$tanggalMulai, $tanggalSampai]);
        }

        // Mendapatkan hasil pencarian
        // $kasusPelanggaran = $query->get();
        $kasusPelanggaran = $query->orderBy('tanggal', 'desc')->get();

        // Mengembalikan tampilan dengan data
        return view('laporan.kasus_pelanggaran', [
            'kasusPelanggaran' => $kasusPelanggaran,
            'title' => 'SMPN 1 KREJENGAN',
            'subtitle' => 'Kelas List',
            'siswa' => $siswa,
        ]);
    }

}
