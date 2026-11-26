@extends('layouts.dashboard')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="flex flex-col gap-1">
        <p class="text-sm font-medium text-emerald-600">Dashboard Mahasiswa</p>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Halo, {{ auth()->user()->name }} 👋
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            @if (auth()->user()->nim)
                NIM {{ auth()->user()->nim }}
                @if (auth()->user()->organisasi)
                    &middot; {{ auth()->user()->organisasi }}
                @endif
            @else
                Selamat datang di sistem reservasi kelas.
            @endif
        </p>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $cards = [
                ['label' => 'Peminjaman Saya', 'value' => $totalPeminjaman, 'color' => 'indigo'],
                ['label' => 'Menunggu', 'value' => $totalMenunggu, 'color' => 'amber'],
                ['label' => 'Disetujui', 'value' => $totalDisetujui, 'color' => 'emerald'],
                ['label' => 'Kelas Tersedia', 'value' => $totalKelas, 'color' => 'violet'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <p class="text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
                <p @class([
                    'mt-2 text-3xl font-bold tracking-tight',
                    'text-indigo-600' => $card['color'] === 'indigo',
                    'text-amber-600' => $card['color'] === 'amber',
                    'text-emerald-600' => $card['color'] === 'emerald',
                    'text-violet-600' => $card['color'] === 'violet',
                ])>{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
            <h2 class="text-base font-semibold text-slate-900">Selamat datang di portal reservasi</h2>
            <p class="mt-2 text-sm leading-relaxed text-slate-500">
                Di sini Anda dapat mengajukan peminjaman ruang kelas dan memantau status
                pengajuan yang telah dikirim.
            </p>

            <div class="mt-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </span>
                <div>
                    <p class="text-sm font-semibold text-emerald-800">Login berhasil</p>
                    <p class="mt-0.5 text-sm text-emerald-700">
                        Anda masuk sebagai mahasiswa. Menu pengajuan peminjaman akan tersedia pada tahap berikutnya.
                    </p>
                </div>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-base font-semibold text-slate-900">Profil singkat</h2>

            <dl class="mt-4 space-y-3 text-sm">
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Nama</dt>
                    <dd class="mt-0.5 font-medium text-slate-800">{{ auth()->user()->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Username</dt>
                    <dd class="mt-0.5 font-medium text-slate-800">{{ auth()->user()->username }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Email</dt>
                    <dd class="mt-0.5 font-medium text-slate-800">{{ auth()->user()->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">NIM</dt>
                    <dd class="mt-0.5 font-medium text-slate-800">{{ auth()->user()->nim ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Organisasi</dt>
                    <dd class="mt-0.5 font-medium text-slate-800">{{ auth()->user()->organisasi ?? '-' }}</dd>
                </div>
            </dl>
        </div>
    </div>
@endsection
