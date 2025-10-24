<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Bibliotheck') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f6f1e8] text-[#263640]" style="font-family: 'Inter', sans-serif;">
    @php
        $user = auth()->user();
        $isAdmin = $user?->isAdmin();
        $navItems = $isAdmin
            ? [
                ['label' => 'Dasbor', 'route' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard'), 'icon' => 'space_dashboard'],
                ['label' => 'Kelola Buku', 'route' => route('admin.books.index'), 'active' => request()->routeIs('admin.books.*'), 'icon' => 'menu_book'],
                ['label' => 'Peminjaman', 'route' => route('admin.borrowings.index'), 'active' => request()->routeIs('admin.borrowings.*'), 'icon' => 'swap_calls'],
            ]
            : [
                ['label' => 'Katalog Buku', 'route' => route('student.books.index'), 'active' => request()->routeIs('student.books.*'), 'icon' => 'collections_bookmark'],
                ['label' => 'Riwayat Peminjaman', 'route' => route('student.borrowings.index'), 'active' => request()->routeIs('student.borrowings.*'), 'icon' => 'history'],
                ['label' => 'Profil', 'route' => route('profile.edit'), 'active' => request()->routeIs('profile.*'), 'icon' => 'manage_accounts'],
            ];
        $pageHeading = $pageHeading ?? ($header ?? null);
        $pageDescription = $pageDescription ?? ($isAdmin ? 'Kelola koleksi dan peminjaman perpustakaan.' : 'Temukan buku favoritmu dan ajukan peminjaman.');
    @endphp

    <div class="relative min-h-screen overflow-hidden">
        <div class="pointer-events-none fixed inset-0 overflow-hidden">
            <div class="absolute -top-40 left-0 h-96 w-96 -translate-x-1/3 rounded-full bg-[#0f766e]/15 blur-3xl"></div>
            <div class="absolute top-32 right-0 h-[28rem] w-[28rem] translate-x-1/3 rounded-full bg-[#f59e0b]/15 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/2 h-[24rem] w-[24rem] -translate-x-1/2 translate-y-24 rounded-full bg-[#fde68a]/25 blur-3xl"></div>
        </div>

        <div class="relative z-10 flex min-h-screen flex-col">
            <header class="border-b border-[#e0d9c8] bg-white/80 backdrop-blur">
                <div class="mx-auto w-full max-w-7xl px-6 py-5">
                    <div class="flex flex-col gap-6">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <a href="{{ $isAdmin ? route('admin.dashboard') : route('student.books.index') }}" class="flex items-center gap-3">
                                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#0f766e] text-lg font-semibold text-white shadow-sm">
                                    B
                                </span>
                                <div>
                                    <p class="text-lg font-semibold tracking-tight text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">
                                        Bibliotheck
                                    </p>
                                    <p class="text-xs uppercase tracking-[0.35em] text-[#5f6b63]">
                                        School Library Console
                                    </p>
                                </div>
                            </a>

                            <div class="flex items-center gap-3">
                                <div class="rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-2 text-xs uppercase tracking-[0.3em] text-[#6b766f] shadow-sm">
                                    {{ $user?->name }} • {{ $user?->role }}
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-[#f97316]/50 bg-[#f97316] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#ea580c]">
                                        <span class="material-symbols-rounded text-base">logout</span>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <nav class="flex flex-wrap items-center gap-2">
                            @foreach ($navItems as $item)
                                <a href="{{ $item['route'] }}" class="group inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] transition
                                    @if($item['active'])
                                        border-[#0f766e] bg-[#0f766e] text-white shadow-sm
                                    @else
                                        border-[#dcd2bd] bg-white/70 text-[#4c5b54] hover:border-[#0f766e]/40 hover:text-[#0f766e]
                                    @endif">
                                    <span class="material-symbols-rounded text-base">{{ $item['icon'] }}</span>
                                    {{ $item['label'] }}
                                </a>
                            @endforeach
                        </nav>

                        <form method="POST" action="{{ route('logout') }}" class="md:hidden">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-[#f97316]/40 bg-[#f97316]/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#b45309] transition hover:border-[#f97316]/60 hover:bg-[#f97316]/20">
                                <span class="material-symbols-rounded text-base">logout</span>
                                Keluar dari Bibliotheck
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1">
                <section class="border-b border-[#e0d9c8]/80 bg-white/70">
                    <div class="mx-auto w-full max-w-7xl px-6 py-10">
                        <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                            <div>
                                @if ($pageHeading)
                                    <div class="text-3xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">
                                        {!! $pageHeading !!}
                                    </div>
                                @endif
                                @if ($pageDescription)
                                    <p class="mt-2 text-sm text-[#4c5b54]">
                                        {{ $pageDescription }}
                                    </p>
                                @endif
                            </div>
                            <div class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-[0.3em] text-[#6b766f]">
                                <span class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] bg-white px-4 py-2">
                                    <span class="material-symbols-rounded text-base text-[#0f766e]">lock</span>
                                    Sesi aman
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] bg-white px-4 py-2">
                                    <span class="material-symbols-rounded text-base text-[#f97316]">insights</span>
                                    Data real-time
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-10">
                    <div class="mx-auto w-full max-w-7xl px-6 space-y-8">
                        @if (session('status'))
                            <div class="rounded-[1.75rem] border border-[#166534]/30 bg-[#dcfce7] px-5 py-4 text-sm text-[#166534] shadow-sm">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="space-y-8 rounded-[2.5rem] border border-[#dcd2bd] bg-white/80 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.5)]">
                            {{ $slot }}
                        </div>
                    </div>
                </section>
            </main>

            <footer class="border-t border-[#e0d9c8] bg-white/80 py-6">
                <div class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-6 text-xs text-[#4c5b54] md:flex-row">
                    <p>&copy; {{ now()->year }} Bibliotheck.</p>
                    <p class="flex items-center gap-2">
                        <span class="material-symbols-rounded text-sm text-[#0f766e]">code_blocks</span>
                        Laravel 12 • TailwindCSS • Breeze
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
