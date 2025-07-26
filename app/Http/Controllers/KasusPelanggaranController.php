<?php
// app/Http/Controllers/KasusPelanggaranController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KasusPelanggaran;
use App\Models\DetailPelanggaran;
use App\Models\Siswa;
use App\Models\Wali;
use App\Models\JenisPelanggaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class KasusPelanggaranController extends Controller
{
    public function index()
    {
        // $userId = Auth::id();
        $role = Auth::user()->role_user;
        if ($role === 'admin') {
            // Jika admin, tampilkan semua kasus pelanggaran
            // $kasusPelanggaran = KasusPelanggaran::all();
            $kasusPelanggaran = KasusPelanggaran::orderBy('tanggal', 'desc')->get();
        } else {
            // Jika bukan admin, tampilkan hanya kasus pelanggaran untuk pengguna ini
            $kasusPelanggaran = KasusPelanggaran::where('id', Auth::id())->orderBy('tanggal', 'desc')->get();
            // $kasusPelanggaran = KasusPelanggaran::where('user_id', $userId)
            //     ->orderBy('tanggal', 'desc')
            //     ->get();
        }

        $kasusPelanggaran = KasusPelanggaran::where('id', Auth::id())->get();

        // \Log::info('Files in uploads folder: ' . implode(', ', $files));

        return view('kasus_pelanggaran.index', [
            'kasusPelanggaran' => $kasusPelanggaran,
            'title' => 'SMPN 1 KREJENGAN',
            'subtitle' => 'Buat Kasus Pelanggaran Baru'
        ]);
    }

    public function create()
    {
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        return view('kasus_pelanggaran.create', [
            'siswa' => $siswa,
            'jenisPelanggaran' => $jenisPelanggaran,
            'title' => 'SMPN 1 KREJENGAN',
            'subtitle' => 'Buat Kasus Pelanggaran Baru'
        ]);
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
            // 'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'tanggal.*' => 'required|date',
            'tahun_ajaran' => 'required|string',
            'details.*.jenis_pelanggaran_id' => 'required|exists:tb_jenispelanggaran,id_jenispelanggaran',
        ]);
        //dd($request->all());

        // Cek apakah kasus pelanggaran sudah ada
        $existingKasus = KasusPelanggaran::where('id_siswa', $request->id_siswa)
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->first();

        if ($existingKasus) {
            $kasusPelanggaran = $existingKasus;
        } else {
            // Simpan kasus pelanggaran tanpa kolom tanggal
            // dd($request->total_poin);
            $kasusPelanggaran = KasusPelanggaran::create([
                'id_siswa' => $request->id_siswa,
                'tahun_ajaran' => $request->tahun_ajaran,
                'id' => auth()->id(),
                'total_poin' => $request->total_poin,
            ]);
        }

        $totalPoin = 0;

        // Cek file yang ada di folder
        // $files = Storage::files('public/uploads');
        foreach ($request->details as $index => $detail) {
            $file = $request->file('bukti')[$index] ?? null;

            if ($file) {
                $buktiFileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads', $buktiFileName);
            } else {
                $buktiFileName = 'kosong.png'; // Nama file jika tidak ada file
            }

            $poin = $request->details[$index]['total_poin'] ?? 0;

            // Simpan detail pelanggaran
            DetailPelanggaran::create([
                'id_kasus' => $kasusPelanggaran->id_kasus,
                'id_jenispelanggaran' => $detail['jenis_pelanggaran_id'],
                'tanggal' => $request->tanggal[$index],
                'bukti' => $buktiFileName,
                'poin' => $poin,
            ]);

            $totalPoin += $poin;
        }


        // Update total poin di KasusPelanggaran
        // $kasusPelanggaran->update(['total_poin' => $totalPoin]);
        //     // Retrieve student and guardian info
        $siswa = Siswa::find($request->id_siswa);
        $wali = Wali::where('id_siswa', $request->id_siswa)->first();
        $phone = $wali ? $wali->no_wa : 'unknown';

        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        $message = "🔔 **Kasus Pelanggaran Baru**\n\n";
        $message .= "👤 *Nama Siswa :* " . $siswa->nama_siswa . "\n";
        // $message .= "📅 **Tanggal:** " . $kasusPelanggaran->tanggal . "\n";
        $message .= "📚 *Tahun Ajaran :* " . $kasusPelanggaran->tahun_ajaran . "\n";
    $message .= "🏫 Kelas: " . ($siswa->kelas->nama_kelas ?? '-') . "\n\n";
        $message .= "    =============== \n";

        $message .= "📜 *Detail Pelanggaran :*\n";

        foreach ($request->details as $index => $detail) {
            $jenisPelanggaran = JenisPelanggaran::find($detail['jenis_pelanggaran_id']);
            $message .= "   🔖 *Nama Pelanggaran :* " . $jenisPelanggaran->nama_pelanggaran . "\n";
            $message .= "   📂 *Kategori :* " . $jenisPelanggaran->kategori . "\n";
            $message .= "   🏆 *Poin :* " . $jenisPelanggaran->poin . "\n";
            $message .= "   📅 *Tanggal :* " . $request->tanggal[$index] . "\n";

            // $message .= "   ⚠️ *Sanksi :* " . $jenisPelanggaran->sanksi . "\n";

            $message .= "    =============== \n";
        }

        // Normalisasi nomor WA
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Kirim WhatsApp via Fonnte
        $token = "7QK1Q9ztEvC5Yk4M9hQH"; // Ganti token kamu
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => array(
                'target' => $phone,
                'message' => $message,
                'countryCode' => '62'
            ),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        // Debug: simpan log response (opsional)
        Log::info("Fonnte response: " . $response);




        return redirect()->route('kasus_pelanggaran.index')->with('sukses', 'Kasus pelanggaran berhasil disimpan.');
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_siswa' => 'required|exists:tb_siswa,id_siswa',
    //         'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
    //         'tanggal.*' => 'required|date',
    //         'tahun_ajaran' => 'required|string',
    //         'details.*.jenis_pelanggaran_id' => 'required|exists:tb_jenispelanggaran,id_jenispelanggaran',
    //     ]);

    //     $kasus = KasusPelanggaran::firstOrCreate(
    //         ['id_siswa' => $request->id_siswa, 'tahun_ajaran' => $request->tahun_ajaran],
    //         ['id' => auth()->id(), 'total_poin' => 0]
    //     );

    //     $totalPoin = 0;

    //     foreach ($request->details as $index => $detail) {
    //         $poin = $detail['total_poin'] ?? 0;
    //         $file = $request->file('bukti')[$index] ?? null;

    //         $buktiFileName = $file
    //             ? time() . '_' . $file->getClientOriginalName()
    //             : 'kosong.png';

    //         if ($file) {
    //             $file->storeAs('public/uploads', $buktiFileName);
    //         }

    //         DetailPelanggaran::create([
    //             'id_kasus' => $kasus->id_kasus,
    //             'id_jenispelanggaran' => $detail['jenis_pelanggaran_id'],
    //             'tanggal' => $request->tanggal[$index],
    //             'bukti' => $buktiFileName,
    //             'poin' => $poin,
    //         ]);

    //         $totalPoin += $poin;
    //     }

    //     // Update total poin
    //     $kasus->update(['total_poin' => $kasus->details->sum('jenis_pelanggaran.poin')]);

    //     // Ambil info siswa & wali
    //     $siswa = Siswa::with('kelas')->find($request->id_siswa);
    //     $wali = Wali::where('id_siswa', $request->id_siswa)->first();

    //     $phone = $wali ? preg_replace('/[^0-9]/', '', $wali->no_wa) : null;
    //     if ($phone && substr($phone, 0, 1) === '0') {
    //         $phone = '62' . substr($phone, 1);
    //     }

    //     // Ambil detail pelanggaran dari database (pastikan include relasi jenis_pelanggaran)
    //     $details = $kasus->details()->with('jenis_pelanggaran')->get();

    //     // Format pesan
    //     $message = "Assalamu'alaikum Wr. Wb.\n\n";
    //     $message .= "Yth. Bapak/Ibu Wali Murid dari {$siswa->nama_siswa},\n\n";
    //     $message .= "🏫 Kelas: " . ($siswa->kelas->nama_kelas ?? '-') . "\n\n";
    //     $message .= "Dengan ini kami informasikan bahwa putra/putri Bapak/Ibu telah melakukan pelanggaran dengan rincian:\n\n";

    //     foreach ($details as $detail) {
    //         $tanggal = \Carbon\Carbon::parse($detail->tanggal)->format('d-m-Y');
    //         $pelanggaran = $detail->jenis_pelanggaran->nama_pelanggaran ?? '-';
    //         $poin = $detail->poin ?? 0;

    //         $message .= "📅 Tanggal: {$tanggal}\n";
    //         $message .= "🚫 Pelanggaran: {$pelanggaran}\n";
    //         $message .= "⭐ Poin: {$poin}\n";
    //         $message .= "====================\n";
    //     }

    //     $message .= "\nTotal Poin: {$totalPoin}\n\n";
    //     $message .= "Harap melakukan pembinaan lebih lanjut di rumah.\n\n";
    //     $message .= "Wassalamu'alaikum Wr. Wb.\n\n";
    //     $message .= "SMPN 1 Krejengan";

    //     // Kirim via Fonnte
    //     $token = "7QK1Q9ztEvC5Yk4M9hQH"; // Ganti dengan token kamu
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.fonnte.com/send',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_POST => true,
    //         CURLOPT_POSTFIELDS => array(
    //             'target' => $phone,
    //             'message' => $message,
    //             'countryCode' => '62'
    //         ),
    //         CURLOPT_HTTPHEADER => array(
    //             "Authorization: $token"
    //         ),
    //     ));
    //     $response = curl_exec($curl);
    //     curl_close($curl);

    //     Log::info("WA sent to {$phone} | Response: {$response}");

    //     return redirect()->route('kasus_pelanggaran.index')->with('sukses', 'Kasus pelanggaran berhasil disimpan dan notifikasi dikirim.');
    // }




    public function edit($id)
    {
        $kasus = KasusPelanggaran::findOrFail($id);
        $siswa = Siswa::all();
        $jenisPelanggaran = JenisPelanggaran::all();
        return view('kasus_pelanggaran.edit', compact('kasus', 'siswa', 'jenisPelanggaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_siswa' => 'required|exists:tb_siswa,id_siswa',
            'bukti' => 'required|string',
            'tanggal' => 'required|date',
            'tahun_ajaran' => 'required|string',
            'total_poin' => 'required|integer',
            'jenis_pelanggaran' => 'required|array',
        ]);

        $kasus = KasusPelanggaran::findOrFail($id);
        $kasus->update([
            'id_siswa' => $request->id_siswa,
            'bukti' => $request->bukti,
            'tanggal' => $request->tanggal,
            'tahun_ajaran' => $request->tahun_ajaran,
            'total_poin' => $request->total_poin,
        ]);

        // Hapus detail pelanggaran yang lama
        DetailPelanggaran::where('id_kasus', $id)->delete();

        foreach ($request->jenis_pelanggaran as $jenis) {
            DetailPelanggaran::create([
                'id_kasus' => $id,
                'id_jenispelanggaran' => $jenis
            ]);
        }

        return redirect()->route('kasus_pelanggaran.index')->with('sukses', 'Kasus pelanggaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan kasus pelanggaran berdasarkan ID
        $kasusPelanggaran = KasusPelanggaran::findOrFail($id);

        // Temukan semua detail pelanggaran terkait dengan kasus ini
        $details = DetailPelanggaran::where('id_kasus', $id)->get();

        // Hapus file gambar yang terkait dengan detail pelanggaran
        foreach ($details as $detail) {
            if ($detail->bukti && $detail->bukti !== 'kosong.png') {
                $filePath = storage_path('app/public/uploads/' . $detail->bukti);
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file
                }
            }
        }

        // Hapus entri di tb_detailpelanggaran berdasarkan id_kasus
        DetailPelanggaran::where('id_kasus', $id)->delete();

        // Hapus entri di tb_kasuspelanggaran
        $kasusPelanggaran->delete();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('kasus_pelanggaran.index')->with('sukses', 'Kasus pelanggaran berhasil dihapus.');
    }

    public function show($id)
    {
        // Log::info('Mencoba mengambil data kasus pelanggaran dengan ID: ' . $id);

        $kasusPelanggaran = KasusPelanggaran::with('details.jenis_pelanggaran')->find($id);

        if (!$kasusPelanggaran) {
            Log::error('Data kasus pelanggaran tidak ditemukan dengan ID: ' . $id);
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        }

        // Log detail pelanggaran
        foreach ($kasusPelanggaran->details as $detail) {
            Log::info('Detail Pelanggaran ID: ' . $detail->id_detail);
            if ($detail->jenis_pelanggaran) {
                Log::info('Nama Pelanggaran: ' . $detail->jenis_pelanggaran->nama_pelanggaran);
                Log::info('Kategori: ' . $detail->jenis_pelanggaran->kategori);
                Log::info('Poin: ' . $detail->jenis_pelanggaran->poin);
                Log::info('Sanksi: ' . $detail->jenis_pelanggaran->sanksi);
            } else {
                Log::info('Jenis Pelanggaran: Tidak Ada');
            }
        }

        return response()->json([
            'details' => $kasusPelanggaran->details->map(function ($detail) {
                return [
                    'jenis_pelanggaran' => [
                        'nama_pelanggaran' => $detail->jenis_pelanggaran->nama_pelanggaran ?? 'Tidak Ada',
                        'kategori' => $detail->jenis_pelanggaran->kategori ?? 'Tidak Ada',
                        'poin' => $detail->jenis_pelanggaran->poin ?? 'Tidak Ada',
                        'sanksi' => $detail->jenis_pelanggaran->sanksi ?? 'Tidak Ada',
                        'tanggal' => $detail->tanggal ?? 'Tidak Ada',
                        'bukti' => $detail->bukti ?? 'Tidak Ada',
                    ]
                ];
            })
        ]);
    }
}
