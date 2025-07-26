<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Menampilkan daftar tahun ajaran.
     */
    public function index()
    {
        $title = 'Tahun Ajaran'; // Misalnya, nama halaman atau judul
        $subtitle = 'Tahun Ajaran'; // Misalnya, nama halaman atau judul
        $tahunajaran = TahunAjaran::all();
        return view('tahun_ajaran.index', compact('tahunajaran', 'title', 'subtitle'));
    }

    /**
     * Menyimpan data tahun ajaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'status' => 'required'
        ]);

        TahunAjaran::create([
            'nama' => $request->nama,
            'status' => $request->status
        ]);

        return redirect()->route('tahunajaran.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit tahun ajaran.
     */
    public function edit($id)
    {
        $tahunajaran = TahunAjaran::findOrFail($id);

        return view('tahunajaran.edit', compact('tahunajaran'));
    }

    /**
     * Memperbarui data tahun ajaran.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:50',
            'status' => 'required'
        ]);

        $tahunajaran = TahunAjaran::findOrFail($id);
        $tahunajaran->update([
            'nama' => $request->nama,
            'status' => $request->status
        ]);

        return redirect()->route('tahunajaran.index')->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    // /**
    //  * Menghapus data tahun ajaran.
    //  */
    // public function destroy($id)
    // {
    //     $tahunajaran = TahunAjaran::findOrFail($id);
    //     $tahunajaran->delete();

    //     return redirect()->route('tahunajaran.index')->with('success', 'Tahun ajaran berhasil dihapus.');
    // }
}
