<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KasusController extends Controller
{
    // Kirim pesan WhatsApp
    public function sendWa($id)
    {
        $kasus = Kasus::findOrFail($id);

        // Pastikan nomor WA valid dan dalam format internasional
        $no_wa = preg_replace('/^0/', '62', $kasus->no_wa);

        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_API_KEY'), // pakai dari .env
        ])->post('https://api.fonnte.com/send', [
            'target' => $no_wa,
            'message' => "Halo, pelanggaran atas nama: {$kasus->id}.",
        ]);
        dd($response->json());
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pesan. Respon: ' . $response->body());
        }
    }

    // Menampilkan form untuk mengubah nomor WhatsApp
    public function editWa($id)
    {
        $kasus = Kasus::with('siswa.wali')->where('id_kasus', $id)->first();
        // return $kasus;
        return view('kasus.edit-wa', compact('kasus'));
        // $kasus = Kasus::with(['details.jenis_pelanggaran', 'siswa'])->findOrFail($id);
        // return view('kasus.edit-wa', compact('kasus'));
    }

    // Menyimpan perubahan nomor WhatsApp
    public function updateWa(Request $request, $id)
    {
        $request->validate([
            'no_wa' => 'required|string',
            'pesan' => 'required|string',
        ]);

        $kasus = Kasus::findOrFail($id);
        $kasus->no_wa = $request->no_wa;
        $kasus->save();

        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_API_KEY'), // pakai dari .env
        ])->post('https://api.fonnte.com/send', [
            'target' => $kasus->no_wa,
            'message' => $request->pesan,
        ]);

        $data = $response->json();

        if ($data['status'] === true) {
            return back()->with('success', 'Pesan berhasil dikirim dan nomor WhatsApp diperbarui.');
        } else {
            return back()->with('error', 'Gagal mengirim pesan. Silakan coba lagi.');
        }
    }
}
