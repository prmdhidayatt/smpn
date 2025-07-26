<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'username'   => 'admin',
            'password'   => Hash::make('admin'),
            'role_user'  => 'admin',
            'keyword'    => 'admin-keyword', // <-- ini WAJIB ditambahkan
        ]);


        // Petugas
        User::create([
            'username'   => 'user',
            'password'   => Hash::make('user123'),
            'role_user'  => 'user',
            'keyword'    => 'user-keyword'
        ]);
    }
}
