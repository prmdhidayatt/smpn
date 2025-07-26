<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kesiswaan;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // return view('auth.register');
        return view('auth.register', ['title' => 'User Registration']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'role_user' => 'required|string',
            'nip' => 'required|string|max:20',
            'nama_kesiswaan' => 'required|string|max:50',
            'jk_kesiswaan' => 'required|in:L,P',
        ]);

        // Set password
        $password = $request->password;

        // Create user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($password),
            'role_user' => $request->role_user,
            'keyword' => $password, // Mengisi keyword dengan password yang tidak dienkripsi
            'photo' => 'avatar.png', // Default photo
        ]);

        // Create tb_kesiswaan entry
        Kesiswaan::create([
            'nip' => $request->nip,
            'nama_kesiswaan' => $request->nama_kesiswaan,
            'jk_kesiswaan' => $request->jk_kesiswaan,
            'id_user' => $user->id,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
