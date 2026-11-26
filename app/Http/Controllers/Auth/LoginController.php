<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman form login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses autentikasi user (admin maupun mahasiswa).
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'username' => 'Username atau password yang Anda masukkan salah.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route($this->dashboardRoute($request));
    }

    /**
     * Logout dan hapus session user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Anda berhasil keluar.');
    }

    /**
     * Tentukan halaman tujuan setelah login berdasarkan role.
     */
    private function dashboardRoute(Request $request): string
    {
        return $request->user()->isAdmin()
            ? 'admin.dashboard'
            : 'user.dashboard';
    }
}
