<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

// Tambahan untuk import
use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with(['tahunAjaran', 'siswas', 'waliKelas'])->withCount('siswas')->get();
        $tahunAjaran = TahunAjaran::all();

        return view('kelas.index', [
            'kelas' => $kelas,
            'tahunAjaran' => $tahunAjaran,
            'subtitle' => 'Data Kelas',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }

    public function show($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $siswa = $kelas->siswas;
        $tahunajar = TahunAjaran::where('status', 'aktif')->get()->first();
        $kelasList = Kelas::where('id_tahunajaran', $tahunajar->id_tahunajaran)->get();

        return view('kelas.siswa', [
            'subtitle' => 'Data Siswa',
            'title' => 'SMPN 1 KREJENGAN',
            'siswa' => $siswa,
            'kelasList' => $kelasList
        ]);
    }

    public function create()
    {
        $walikelas = WaliKelas::all();
        return view('kelas.create', [
            'subtitle' => 'Create Kelas',
            'title' => 'SMPN 1 KREJENGAN',
            'walikelas' => $walikelas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'id_tahunajaran' => 'required|exists:tb_tahunajaran,id_tahunajaran'
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_tahunajaran' => $request->id_tahunajaran,
        ]);

        return redirect()->route('kelas.index')->with('sukses', 'Selamat, data kelas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $walikelas = WaliKelas::all();
        return view('kelas.edit', [
            'kelas' => $kelas,
            'walikelas' => $walikelas,
            'subtitle' => 'Edit Kelas',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50',
            'id_tahunajaran' => 'required|exists:tb_tahunajaran,id_tahunajaran'
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return redirect()->route('kelas.index')->with('sukses', 'Selamat, data kelas berhasil diperbarui');
    }

    public function naikKelas(Request $request)
    {
        $request->validate([
            'kelas_baru' => 'required|exists:tb_kelas,id_kelas',
            'siswa_ids' => 'required|array',
            'siswa_ids.*' => 'exists:tb_siswa,id_siswa',
        ]);

        $kelasBaruId = $request->input('kelas_baru');
        $siswaIds = $request->input('siswa_ids');

        foreach ($siswaIds as $siswaId) {
            $siswa = Siswa::findOrFail($siswaId);
            $siswa->id_kelas = $kelasBaruId;
            $siswa->save();
        }

        return redirect()->route('kelas.show', $kelasBaruId)
            ->with('sukses', 'Siswa berhasil dipindahkan ke kelas yang baru.');
    }

    public function showImportPage()
    {
        return view('kelas.import');
    }

    // 🔽 Tambahan method untuk import siswa dari Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->route('kelas.index')->with('success', 'Data siswa berhasil diimport!');
    }
}
