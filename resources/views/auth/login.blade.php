@extends('layouts.guest')

@section('title', 'Masuk')

@section('content')
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-slate-950 px-4 py-10 sm:px-6">

        {{-- Background --}}
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-indigo-800 to-violet-700"></div>
        <div class="pointer-events-none absolute -left-32 top-0 h-96 w-96 rounded-full bg-indigo-400/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -right-24 bottom-0 h-[28rem] w-[28rem] rounded-full bg-violet-400/25 blur-3xl"></div>
        <div class="pointer-events-none absolute inset-0 opacity-[0.07]"
             style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 22px 22px;"></div>

        <div class="relative z-10 w-full max-w-md">

            {{-- Kartu login --}}
            <div class="rounded-3xl bg-white p-6 shadow-2xl shadow-indigo-950/40 ring-1 ring-white/20 sm:p-8">

                {{-- Brand --}}
                <div class="flex flex-col items-center text-center">
                    <span class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/30">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </span>

                    <p class="mt-4 text-lg font-bold tracking-tight text-slate-900">
                        {{ config('app.name', 'Reservasi Kelas') }}
                    </p>
                    <p class="mt-0.5 text-xs text-slate-500">Sistem Peminjaman Ruang Kelas</p>
                </div>

                <div class="mt-7">
                    <h1 class="text-2xl font-bold tracking-tight text-slate-900">Masuk ke akun Anda</h1>
                    <p class="mt-1.5 text-sm text-slate-500">
                        Gunakan username dan password yang terdaftar.
                    </p>
                </div>

                {{-- Pesan sukses (logout, dsb.) --}}
                @if (session('status'))
                    <div class="mt-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Pesan error --}}
                @if ($errors->any())
                    <div class="mt-5 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">
                        <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3.75h.008v.008H12v-.008ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-4" novalidate>
                    @csrf

                    <div>
                        <label for="username" class="mb-1.5 block text-sm font-semibold text-slate-700">Username</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </span>
                            <input id="username" name="username" type="text" value="{{ old('username') }}" required autofocus
                                autocomplete="username" placeholder="Masukkan username"
                                @class([
                                    'block w-full rounded-xl border bg-white py-3 pl-11 pr-4 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4',
                                    'border-rose-300 focus:border-rose-400 focus:ring-rose-100' => $errors->has('username'),
                                    'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => ! $errors->has('username'),
                                ])>
                        </div>
                        @error('username')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                            <input id="password" name="password" type="password" required
                                autocomplete="current-password" placeholder="Masukkan password"
                                @class([
                                    'block w-full rounded-xl border bg-white py-3 pl-11 pr-12 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4',
                                    'border-rose-300 focus:border-rose-400 focus:ring-rose-100' => $errors->has('password'),
                                    'border-slate-300 focus:border-indigo-500 focus:ring-indigo-100' => ! $errors->has('password'),
                                ])>
                            <button type="button" data-toggle-password="password"
                                class="absolute inset-y-0 right-0 flex items-center px-3.5 text-slate-400 transition hover:text-slate-600 focus:outline-none focus-visible:text-indigo-600"
                                aria-label="Tampilkan password">
                                <svg data-icon="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <svg data-icon="hide" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember" class="flex cursor-pointer items-center gap-2.5 text-sm text-slate-600">
                            <input id="remember" name="remember" type="checkbox" value="1" @checked(old('remember'))
                                class="h-4 w-4 rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            Ingat saya
                        </label>
                    </div>

                    <button type="submit"
                        class="group flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 focus:outline-none focus-visible:ring-4 focus-visible:ring-indigo-200">
                        Masuk
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const showIcon = button.querySelector('[data-icon="show"]');
                const hideIcon = button.querySelector('[data-icon="hide"]');
                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';
                showIcon.classList.toggle('hidden', isHidden);
                hideIcon.classList.toggle('hidden', ! isHidden);
                button.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            });
        });
    </script>
@endsection
