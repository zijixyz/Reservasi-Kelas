@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="flex flex-col gap-1">
        <p class="text-sm font-medium text-indigo-600">Dashboard Admin</p>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Halo, {{ auth()->user()->name }} 👋
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Ringkasan data reservasi kelas hari ini.
        </p>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $cards = [
                ['label' => 'Total Kelas', 'value' => $totalKelas, 'icon' => 'building', 'color' => 'indigo'],
                ['label' => 'Total Peminjaman', 'value' => $totalPeminjaman, 'icon' => 'clipboard', 'color' => 'violet'],
                ['label' => 'Menunggu Persetujuan', 'value' => $totalMenunggu, 'icon' => 'clock', 'color' => 'amber'],
                ['label' => 'Total Mahasiswa', 'value' => $totalMahasiswa, 'icon' => 'users', 'color' => 'emerald'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-slate-500">{{ $card['label'] }}</p>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ $card['value'] }}</p>
                    </div>
                    <span @class([
                        'flex h-11 w-11 shrink-0 items-center justify-center rounded-xl',
                        'bg-indigo-50 text-indigo-600' => $card['color'] === 'indigo',
                        'bg-violet-50 text-violet-600' => $card['color'] === 'violet',
                        'bg-amber-50 text-amber-600' => $card['color'] === 'amber',
                        'bg-emerald-50 text-emerald-600' => $card['color'] === 'emerald',
                    ])>
                        @if ($card['icon'] === 'building')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        @elseif ($card['icon'] === 'clipboard')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                        @elseif ($card['icon'] === 'clock')
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        @else
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Akses Admin</h2>
                    <p class="mt-1 text-sm text-slate-500">Anda masuk sebagai administrator TU.</p>
                </div>
                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    Login aktif
                </span>
            </div>

            <ul class="mt-5 space-y-3 text-sm text-slate-600">
                <li class="flex items-center gap-3">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    Dapat mengelola data kelas dan peminjaman.
                </li>
                <li class="flex items-center gap-3">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    Dapat menyetujui atau menolak pengajuan peminjaman.
                </li>
            </ul>
        </div>

        <div class="rounded-2xl border border-indigo-100 bg-gradient-to-br from-indigo-600 to-violet-600 p-6 text-white shadow-lg shadow-indigo-600/20">
            <h2 class="text-base font-semibold">Menu pengelolaan</h2>
            <p class="mt-2 text-sm leading-relaxed text-indigo-100">
                Fitur pengelolaan kelas dan peminjaman akan tersedia pada tahap pengembangan berikutnya.
            </p>
            <p class="mt-6 text-xs font-medium text-indigo-200">Tahap saat ini: Login &amp; Autentikasi</p>
        </div>
    </div>
@endsection
