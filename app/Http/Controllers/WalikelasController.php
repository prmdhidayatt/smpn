<?php

namespace App\Http\Controllers;

use App\Models\Walikelas;
use App\Models\Kelas;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    public function index()
    {
        $walikelas = WaliKelas::with('kelas')->get();
        $kelas = Kelas::all(); // Tambahkan ini jika diperlukan
        return view('walikelas.index', [
            'walikelas' => $walikelas,
            'subtitle' => 'Data Walikelas',
            'title' => 'SMPN 1 KREJENGAN',
            'kelas' => $kelas // Pastikan ini di-pass ke view
        ]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('walikelas.create', [
            'subtitle' => 'Create Walikelas',
            'title' => 'SMPN 1 KREJENGAN',
            'kelas' => $kelas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip_walikelas' => 'required|string|max:20',
            'nama_walikelas' => 'required|string|max:50',
            'jabatan' => 'required|string|max:30',
            'jk_walikelas' => 'required|in:Laki-laki,Perempuan',
            'tahun_ajaran' => 'required|string|max:20',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
        ]);

        Walikelas::create($request->all());
        return redirect()->route('walikelas.index')->with('sukses', 'Selamat, data wali kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $walikelas = Walikelas::findOrFail($id);
        return view('walikelas.edit', [
            'walikelas' => $walikelas,
            'subtitle' => 'Edit Walikelas',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip_walikelas' => 'required|string|max:20',
            'nama_walikelas' => 'required|string|max:50',
            'jabatan' => 'required|string|max:30',
            'jk_walikelas' => 'required|in:Laki-laki,Perempuan',
        ]);

        $walikelas = Walikelas::findOrFail($id);
        $walikelas->update($request->all());
        return redirect()->route('walikelas.index')->with('sukses', 'Selamat, data wali kelas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $walikelas = Walikelas::findOrFail($id);
        $walikelas->delete();
        return redirect()->route('walikelas.index')->with('sukses', 'Selamat, data wali kelas berhasil dihapus');
    }
}
