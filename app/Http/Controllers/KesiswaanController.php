<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kesiswaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KesiswaanController extends Controller
{
    public function index()
    {
        $kesiswaan = Kesiswaan::all();
        $totalKesiswaan = $kesiswaan->count(); // atau langsung: Kesiswaan::count();

        return view('kesiswaan.index', [
            'kesiswaan' => $kesiswaan,
            'totalKesiswaan' => $totalKesiswaan,
            'subtitle' => 'Data Kesiswaan',
            'title' => 'SMPN 1 KREJENGAN'
        ]);
    }


    public function create()
    {
        return view('kesiswaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:200',
            'password' => 'required|string|max:20|confirmed',
            'role_user' => 'required|string',
            'nip' => 'required|string|max:20',
            'nama_kesiswaan' => 'required|string|max:50',
            'jk_kesiswaan' => 'required|in:L,P',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_user' => $request->role_user,
            'keyword' => $request->password,
            'photo' => 'avatar.png',
        ]);

        Kesiswaan::create([
            'nip' => $request->nip,
            'nama_kesiswaan' => $request->nama_kesiswaan,
            'jk_kesiswaan' => $request->jk_kesiswaan,
            'id_user' => $user->id,
        ]);

        return redirect()->route('kesiswaan.index')->with('sukses', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kesiswaan = Kesiswaan::findOrFail($id);
        return view('kesiswaan.edit', compact('kesiswaan'));
    }

    public function update(Request $request, $id_kesiswaan)
    {
        $request->validate([
            'username' => 'required|string|max:200',
            'password' => 'nullable|string|max:20|confirmed',
            'role_user' => 'required|string',
            'nip' => 'required|string|max:20',
            'nama_kesiswaan' => 'required|string|max:50',
            'jk_kesiswaan' => 'required|in:L,P',
        ]);

        $kesiswaan = Kesiswaan::findOrFail($id_kesiswaan); // Menggunakan id_kesiswaan
        $user = $kesiswaan->user;

        $user->update([
            'username' => $request->username,
            'role_user' => $request->role_user,
            'photo' => 'avatar.png',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->keyword = $request->password;
            $user->save();
        }

        $kesiswaan->update([
            'nip' => $request->nip,
            'nama_kesiswaan' => $request->nama_kesiswaan,
            'jk_kesiswaan' => $request->jk_kesiswaan,
        ]);

        return redirect()->route('kesiswaan.index')->with('sukses', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        $kesiswaan = Kesiswaan::findOrFail($id);
        $kesiswaan->user()->delete(); // Hapus user terkait
        $kesiswaan->delete();

        return redirect()->route('kesiswaan.index')->with('sukses', 'Data berhasil dihapus.');
    }
}
