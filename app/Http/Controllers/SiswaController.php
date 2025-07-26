<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Wali;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $tahunajar = TahunAjaran::where('status', 'aktif')->get()->first();
        $data['siswa'] = Siswa::with('kelas', 'wali')->get();
        $data['kelas'] = Kelas::where('id_tahunajaran', $tahunajar->id_tahunajaran)->get();
        $data['title'] = 'SMPN 1 KREJENGAN';
        $data['subtitle'] = 'Data siswa';
        return view('siswa.index', $data);
    }

    public function create()
    {
        $data['kelas'] = Kelas::all();
        $data['title'] = 'SMPN 1 KREJENGAN';
        $data['subtitle'] = 'Tambah Siswa';
        return view('siswa.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:20|unique:tb_siswa',
            'nama_siswa' => 'required|string|max:50',
            'jk_siswa' => 'required|in:Laki-laki,Perempuan',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
            'alamat' => 'required|string',
            'tahun_ajaran' => 'required|string|max:10',
            'nama_wali' => 'required|string|max:50',
            'no_wa' => 'required|string|max:15',
        ]);

        $siswa = Siswa::create($request->only(['nisn', 'nama_siswa', 'jk_siswa', 'id_kelas', 'alamat', 'tahun_ajaran']));
        Wali::create([
            'id_siswa' => $siswa->id_siswa,
            'nama_wali' => $request->nama_wali,
            'no_wa' => $request->no_wa,
        ]);

        return redirect()->route('siswa.index')->with('sukses', 'Selamat, data siswa berhasil diperbarui');
    }

    public function edit($id)
    {
        $data['siswa'] = Siswa::with('wali')->findOrFail($id);
        $data['kelas'] = Kelas::all();
        $data['title'] = 'SMPN 1  KREJENGAN';
        $data['subtitle'] = 'Edit Siswa';
        return view('siswa.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required|string|max:20|unique:tb_siswa,nisn,' . $id . ',id_siswa',
            'nama_siswa' => 'required|string|max:50',
            'jk_siswa' => 'required|in:Laki-laki,Perempuan',
            'id_kelas' => 'required|exists:tb_kelas,id_kelas',
            'alamat' => 'required|string',
            'tahun_ajaran' => 'required|string|max:10',
            'nama_wali' => 'required|string|max:50',
            'no_wa' => 'required|string|max:15',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->only(['nisn', 'nama_siswa', 'jk_siswa', 'id_kelas', 'alamat', 'tahun_ajaran']));

        $wali = Wali::where('id_siswa', $id)->firstOrFail();
        $wali->update([
            'nama_wali' => $request->nama_wali,
            'no_wa' => $request->no_wa,
        ]);

        return redirect()->route('siswa.index')->with('sukses', 'Selamat, data siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        Wali::where('id_siswa', $id)->delete();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('sukses', 'Selamat, data siswa berhasil dihapus');
    }
    public function checkNisn(Request $request)
    {
        $nisn = $request->input('nisn');
        $exists = Siswa::where('nisn', $nisn)->exists();

        return response()->json(['exists' => $exists]);
    }
}
