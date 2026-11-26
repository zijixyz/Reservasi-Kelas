<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun Admin TU
        User::create([
            'name' => 'Admin TU',
            'username' => 'admin',
            'email' => 'admin@jember.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Akun Mahasiswa
        User::create([
            'name' => 'Aji Pangestu',
            'username' => 'aji',
            'email' => 'aji@student.ac.id',
            'nim' => '252410103104',
            'organisasi' => 'HIMATIF',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);
    }
}
