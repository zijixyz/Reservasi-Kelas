<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_kelas' => 'Lab Jaringan', 'kapasitas' => 30, 'fasilitas' => 'AC, Proyektor, Komputer', 'status' => 'tersedia'],
            ['nama_kelas' => 'Ruang A101', 'kapasitas' => 40, 'fasilitas' => 'AC, Proyektor, Whiteboard', 'status' => 'tersedia'],
            ['nama_kelas' => 'Ruang B202', 'kapasitas' => 25, 'fasilitas' => 'Kipas, Whiteboard', 'status' => 'tersedia'],
        ];

        foreach ($data as $d) {
            Kelas::create($d);
        }
    }
}
