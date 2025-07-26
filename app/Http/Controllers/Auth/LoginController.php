<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Ensure this is imported
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login', ['title' => 'Login']);
    }

    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required',
    //         'password' => 'required',
    //         'role_user' => 'required'

    //     ]);

    //     if ($validator->fails()) {
    //         return back()->with('info', 'Pastikan Kolom Input Terisi Semua');
    //     } else {
    //         $username = $request->input('username');
    //         $password = $request->input('password');
    //         $role_user = $request->input('role_user');

    //         if (Auth::attempt(['username' => $username, 'password' => $password])) {
    //             if (Auth::user()->role_user == $role_user) {
    //                 if (Auth::user()->role_user == 'admin') {
    //                     return redirect()->route('admin.dashboard');
    //                 } elseif (Auth::user()->role_user == 'user') {
    //                     return redirect()->route('admin.dashboard');
    //                 }
    //             } else {
    //                 Auth::logout();
    //                 return redirect()->route('login')->with('gagal', 'Maaf, Peran Pengguna yang Anda Pilih Tidak Sesuai');
    //             }
    //         } else {
    //             return redirect()->route('login')->with('gagal', 'Maaf, Nama Pengguna Atau Kata Sandi Yang Anda Masukkan Salah');
    //         }
    //     }
    // }

//     public function login(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'username' => 'required',
//         'password' => 'required',
//         'role_user' => 'required',
//     ]);

//     if ($validator->fails()) {
//         return back()->with('info', 'Pastikan Kolom Input Terisi Semua');
//     }

//     $credentials = $request->only('username', 'password');

//     if (Auth::attempt($credentials)) {
//         $user = Auth::user();

//         if ($user->role_user !== $request->role_user) {
//             Auth::logout();
//             return redirect()->route('login')->with('gagal', 'Peran pengguna tidak sesuai.');
//         }

//         return redirect()->route('admin.dashboard');
//     } else {
//         return redirect()->route('login')->with('gagal', 'Username atau password salah.');
//     }
// }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('info', 'Pastikan kolom Username dan Password terisi semua');
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Arahkan berdasarkan role dari database
            if ($user->role_user === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role_user === 'user') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('login')->with('gagal', 'Role tidak dikenali.');
            }
        }

        return redirect()->route('login')->with('gagal', 'Username atau password salah.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('sukses', 'Selamat, Anda berhasil keluar');;
    }
}
