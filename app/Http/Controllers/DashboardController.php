<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard untuk admin TU.
     */
    public function admin(): View
    {
        return view('dashboard.admin', [
            'totalKelas' => Kelas::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'totalMenunggu' => Peminjaman::where('status', 'pending')->count(),
            'totalMahasiswa' => User::where('role', 'mahasiswa')->count(),
        ]);
    }

    /**
     * Dashboard untuk mahasiswa.
     */
    public function user(): View
    {
        $user = auth()->user();

        return view('dashboard.user', [
            'totalPeminjaman' => $user->peminjaman()->count(),
            'totalMenunggu' => $user->peminjaman()->where('status', 'pending')->count(),
            'totalDisetujui' => $user->peminjaman()->where('status', 'disetujui')->count(),
            'totalKelas' => Kelas::where('status', 'tersedia')->count(),
        ]);
    }
}
