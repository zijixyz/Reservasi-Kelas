<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

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
            'email' => 'admin@jember.ac.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Akun Mahasiswa
        User::create([
            'name' => 'Aji Pangestu',
            'email' => 'aji@student.ac.id',
            'nim' => '252410103104',
            'organisasi' => 'HIMATIF',
            'password' => bcrypt('password'),
            'role' => 'mahasiswa',
        ]);
    }
}
