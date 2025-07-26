<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    public function index()
    {
        $jenisPelanggaran = JenisPelanggaran::all();
        return view('jenis_pelanggaran.index', [
            'jenisPelanggaran' => $jenisPelanggaran,
            'subtitle' => 'Data Jenis Pelanggaran',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }

    public function create()
    {
        return view('jenis_pelanggaran.create', [
            'subtitle' => 'Create Jenis Pelanggaran',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'poin' => 'required|integer',
            'sanksi' => 'required|string',
        ]);

        JenisPelanggaran::create($request->all());
        return redirect()->route('jenis_pelanggaran.index')->with('success', 'Jenis Pelanggaran created successfully.');
    }

    public function edit($id)
    {
        $jenisPelanggaran = JenisPelanggaran::findOrFail($id);
        return view('jenis_pelanggaran.edit', [
            'jenisPelanggaran' => $jenisPelanggaran,
            'subtitle' => 'Edit Jenis Pelanggaran',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggaran' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'poin' => 'required|integer',
            'sanksi' => 'required|string',
        ]);

        $jenisPelanggaran = JenisPelanggaran::findOrFail($id);
        $jenisPelanggaran->update($request->all());
        return redirect()->route('jenis_pelanggaran.index')->with('success', 'Jenis Pelanggaran updated successfully.');
    }

    public function destroy($id)
    {
        $jenisPelanggaran = JenisPelanggaran::findOrFail($id);
        $jenisPelanggaran->delete();
        return redirect()->route('jenis_pelanggaran.index')->with('success', 'Jenis Pelanggaran deleted successfully.');
    }
}
