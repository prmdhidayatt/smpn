<?php

// app/Http/Controllers/AdminDashboardController.php

// app/Http/Controllers/AdminDashboardController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\JenisPelanggaran;
use App\Models\KasusPelanggaran;
use App\Models\Kesiswaan;


class AdminDashboardController extends Controller
{
    public function index()
    {
        $auth = Auth::user();

        // Log role and ID of the user
        Log::info('User Details:', [
            'id' => $auth->id,
            'username' => $auth->username,
            'role_user' => $auth->role_user
        ]);

        if ($auth->role_user === 'admin') {
            Log::info('Admin user logged in.');
        } else {
            Log::warning('Non-admin user logged in.');
        }

        // Ambil data dashboard
        $jumlahSiswa = Siswa::count();
        $jumlahKelas = Kelas::count();
        $jumlahPengguna = User::count();
        $jenisPelanggaran = JenisPelanggaran::count();
        $totalKesiswaan = Kesiswaan::count();

        $kelasTerbanyak = DB::table('tb_kasuspelangaran')
            ->select('tb_kelas.nama_kelas', DB::raw('SUM(tb_jenispelanggaran.poin) as total_poin'))
            ->join('tb_detailpelanggaran', 'tb_kasuspelangaran.id_kasus', '=', 'tb_detailpelanggaran.id_kasus')
            ->join('tb_jenispelanggaran', 'tb_detailpelanggaran.id_jenispelanggaran', '=', 'tb_jenispelanggaran.id_jenispelanggaran')
            ->join('tb_siswa', 'tb_kasuspelangaran.id_siswa', '=', 'tb_siswa.id_siswa')
            ->join('tb_kelas', 'tb_siswa.id_kelas', '=', 'tb_kelas.id_kelas')
            ->groupBy('tb_kelas.nama_kelas')
            ->orderBy('total_poin', 'desc')
            ->get();

        $top4Pelanggaran = DB::select(DB::raw('
            SELECT tb_jenispelanggaran.nama_pelanggaran, COUNT(DISTINCT tb_kasuspelangaran.id_siswa) AS total_siswa
            FROM tb_kasuspelangaran
            INNER JOIN tb_detailpelanggaran
                ON tb_kasuspelangaran.id_kasus = tb_detailpelanggaran.id_kasus
            INNER JOIN tb_jenispelanggaran
                ON tb_detailpelanggaran.id_jenispelanggaran = tb_jenispelanggaran.id_jenispelanggaran
            GROUP BY tb_jenispelanggaran.nama_pelanggaran
            ORDER BY total_siswa DESC
            LIMIT 4
        '));

        $top4Siswa = DB::select(DB::raw('
            SELECT tb_siswa.nama_siswa, tb_kelas.nama_kelas, SUM(tb_jenispelanggaran.poin) AS total_poin
            FROM tb_kasuspelangaran
            INNER JOIN tb_detailpelanggaran ON tb_kasuspelangaran.id_kasus = tb_detailpelanggaran.id_kasus
            INNER JOIN tb_jenispelanggaran ON tb_detailpelanggaran.id_jenispelanggaran = tb_jenispelanggaran.id_jenispelanggaran
            INNER JOIN tb_siswa ON tb_kasuspelangaran.id_siswa = tb_siswa.id_siswa
            INNER JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id_kelas
            GROUP BY tb_siswa.id_siswa, tb_siswa.nama_siswa, tb_kelas.nama_kelas
            ORDER BY total_poin DESC
            LIMIT 4
        '));

        return view('admin.dashboard', [
            'subtitle' => 'Dashboard',
            'title' => 'SMPN 1 KREJENGAN',
            'auth' => $auth,
            'jumlahSiswa' => $jumlahSiswa,
            'jumlahKelas' => $jumlahKelas,
            'jumlahPengguna' => $jumlahPengguna,
            'jenisPelanggaran' => $jenisPelanggaran,
            'totalKesiswaan' => $totalKesiswaan,
            'kelasTerbanyak' => $kelasTerbanyak,
            'top4Pelanggaran' => $top4Pelanggaran,
            'top4Siswa' => $top4Siswa,
        ]);
    }

    // public function dashboard()
    // {
    //     $status = 'aktif'; // atau nilai yang sesuai logika Anda

    //     return view('admin.dashboard', compact('status'));
    // }
}
