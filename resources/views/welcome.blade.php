<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bibliotech | Perpustakaan Sekolah yang Terhubung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen bg-[#f6f1e8] text-[#24323f] antialiased " style="font-family: 'Inter', sans-serif;">
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 -left-24 h-96 w-96 rounded-full bg-[#f1bc7a]/40 blur-3xl"></div>
        <div class="absolute top-24 right-0 h-[26rem] w-[26rem] translate-x-1/4 rounded-full bg-[#0f766e]/25 blur-3xl">
        </div>
        <div
            class="absolute bottom-0 left-1/2 h-[20rem] w-[20rem] -translate-x-1/2 translate-y-24 rounded-full bg-[#fde68a]/40 blur-3xl">
        </div>
    </div>

    <header class="relative border-b border-[#e0d9c8] bg-white/80 backdrop-blur">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6 px-6 py-5">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#115e59] text-lg font-semibold text-white shadow-md transition-all duration-300 ease-out 
           hover:scale-110 hover:shadow-[0_0_15px_#f97316]">
                    B
                </span>

                <div class="group inline-block transition-all duration-300 hover:scale-105">
                    <p class="text-lg font-semibold tracking-tight transition-colors duration-300 group-hover:text-[#f97316]"
                        style="font-family: 'Space Grotesk', sans-serif;">
                        Bibliotech
                    </p>
                    <p
                        class="text-xs uppercase tracking-[0.35em] text-[#5f6b63] transition-colors duration-300 group-hover:text-[#f97316]">
                        School Library
                    </p>
                </div>

            </a>
            <nav class="hidden items-center gap-4 text-sm text-[#4c5b54] md:flex">
                <a href="#discover"
                    class="rounded-full px-4 py-2 transition hover:bg-[#0f766e]/10 hover:text-[#0f766e]">Beranda</a>
                <a href="#koleksi"
                    class="rounded-full px-4 py-2 transition hover:bg-[#0f766e]/10 hover:text-[#0f766e]">Koleksi</a>
            </nav>
            <div class="flex items-center gap-3 text-sm">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.books.index') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/30 bg-[#0f766e]/10 px-4 py-2 font-semibold text-[#0f766e] transition hover:border-[#0f766e]/50 hover:bg-[#0f766e]/20">
                        <span class="material-symbols-rounded text-base">space_dashboard</span>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/30 px-4 py-2 font-semibold text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/10">
                        <span class="material-symbols-rounded text-base">login</span>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="group relative inline-flex items-center gap-2 overflow-hidden rounded-full bg-[#f97316] px-5 py-2 font-semibold text-white shadow-sm transition-all duration-300 hover:bg-[#ea580c] focus:outline-none">

                        <span class="material-symbols-rounded text-base">person_add</span>
                        Daftar

                        <!-- Cahaya hover mirip logout -->
                        <span
                            class="absolute -left-full top-0 h-full w-2 bg-white/30 transform -skew-x-12 transition-all duration-500 group-hover:left-full"></span>
                    </a>


                @endauth
            </div>
        </div>
    </header>

    <main class="relative z-10 flex-1 pb-16">
        <section id="discover" class="border-b border-[#e0d9c8]/80">
            <div class="mx-auto w-full max-w-7xl px-6 py-24">
                <div class="grid gap-14 lg:grid-cols-[1.15fr_0.85fr]">
                    <div class="space-y-8">
                        <span
                            class="inline-flex items-center gap-2 rounded-full bg-white/80 px-5 py-2 text-xs font-semibold uppercase tracking-[0.4em] text-[#586055] shadow-sm">
                            <span class="material-symbols-rounded text-sm text-[#f97316]">auto_stories</span>
                            Katalog Terintegrasi
                        </span>
                        <div class="space-y-4">
                            <h1 class="text-4xl font-semibold leading-tight text-[#172a37] md:text-5xl"
                                style="font-family: 'Space Grotesk', sans-serif;">
                                Temukan, pantau, dan kurasi koleksi buku sekolah dengan tampilan yang lebih hangat.
                            </h1>
                            <p class="max-w-xl text-base leading-relaxed text-[#425051]">
                                Bibliotech menghadirkan pengalaman perpustakaan sekolah yang terasa personal. Koleksi
                                dikurasi, data stok real-time, dan proses peminjaman yang cair untuk admin maupun siswa.
                            </p>
                        </div>

                        <form method="GET"
                            class="rounded-[2rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_25px_60px_-35px_rgba(16,87,82,0.45)] backdrop-blur">
                            <div class="grid gap-4 md:grid-cols-[1.5fr_1.1fr_auto] md:items-end">
                                <div>
                                    <label for="hero-search"
                                        class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Cari
                                        judul atau penulis</label>
                                    <div
                                        class="mt-2 flex items-center gap-3 rounded-[1.5rem] border border-[#dcd2bd] bg-white px-4 py-2.5 focus-within:border-[#0f766e] focus-within:ring-2 focus-within:ring-[#0f766e]/20">
                                        <span class="material-symbols-rounded text-[#a0a89f]">search</span>
                                        <input id="hero-search" type="text" name="q" value="{{ $search }}"
                                            placeholder="Masukkan kata kunci"
                                            class="w-full border-0 bg-transparent text-sm text-[#1c2d2f] placeholder:text-[#9aa29a] focus:ring-0" />
                                    </div>
                                </div>
                                <div>
                                    <label for="hero-category"
                                        class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kategori</label>
                                    <select id="hero-category" name="category"
                                        class="mt-2 w-full rounded-[1.5rem] border border-[#dcd2bd] bg-white px-4 py-2.5 text-sm text-[#1c2d2f] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">
                                        <option value="">Semua kategori</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item }}" @selected($item === $activeCategory)>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 rounded-[1.5rem] bg-[#0f766e] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#115e59] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/30">
                                    <span class="material-symbols-rounded text-base">travel_explore</span>
                                    Telusuri
                                </button>
                            </div>
                        </form>

                        <dl class="grid gap-6 sm:grid-cols-3">
                            <div class="rounded-3xl border border-[#d5c7a8] bg-white/80 px-6 py-5 shadow-sm">
                                <dt class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Koleksi
                                    hidup</dt>
                                <dd class="mt-2 text-2xl font-semibold text-[#172a37]"
                                    style="font-family: 'Space Grotesk', sans-serif;">{{ $books->total() }}</dd>
                                <dd class="mt-1 text-xs text-[#5b6762]">buku tercatat dan terus bertambah</dd>
                            </div>
                            <div class="rounded-3xl border border-[#d5c7a8] bg-white/80 px-6 py-5 shadow-sm">
                                <dt class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kurasi
                                    kategori</dt>
                                <dd class="mt-2 text-2xl font-semibold text-[#172a37]"
                                    style="font-family: 'Space Grotesk', sans-serif;">{{ $categories->count() }}</dd>
                                <dd class="mt-1 text-xs text-[#5b6762]">bidang minat sebagai penanda eksplorasi</dd>
                            </div>
                            <div class="rounded-3xl border border-[#d5c7a8] bg-white/80 px-6 py-5 shadow-sm">
                                <dt class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Akses
                                    bersama</dt>
                                <dd class="mt-2 text-2xl font-semibold text-[#172a37]"
                                    style="font-family: 'Space Grotesk', sans-serif;">24/7</dd>
                                <dd class="mt-1 text-xs text-[#5b6762]">akses katalog kapanpun melalui web</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="relative">
                        <div
                            class="absolute -top-16 left-6 hidden h-24 w-24 rounded-[2rem] border border-[#d5c7a8] md:block">
                        </div>
                        <div
                            class="relative grid gap-6 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_28px_80px_-40px_rgba(15,87,82,0.55)]">
                            <div class="rounded-[2rem] border border-dashed border-[#e4d8be] bg-[#fbf6ec] p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Alur baru</p>
                                <p class="mt-3 text-lg font-semibold text-[#172a37]"
                                    style="font-family: 'Space Grotesk', sans-serif;">
                                    Tampilan kartu peminjaman yang intuitif untuk menandai status buku dalam sekali
                                    klik.
                                </p>
                            </div>
                            <div class="rounded-[2rem] bg-[#0f766e] p-6 text-white">
                                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">Untuk Admin
                                </p>
                                <p class="mt-4 text-lg font-semibold" style="font-family: 'Space Grotesk', sans-serif;">
                                    Panel ringkas untuk memantau stok, permintaan terbaru, dan tindakan cepat.
                                </p>
                                <div
                                    class="mt-5 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white/80">
                                    <span class="material-symbols-rounded text-sm">bolt</span>
                                    3 langkah selesai
                                </div>
                            </div>
                            <div class="rounded-[2rem] border border-[#f4bb7a] bg-[#fff1dc] p-6">
                                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#d97706]">Untuk Siswa
                                </p>
                                <p class="mt-3 text-lg font-semibold text-[#2d3c32]"
                                    style="font-family: 'Space Grotesk', sans-serif;">
                                    Pengalaman membaca sinopsis yang lebih kaya, lengkap dengan stok dan estimasi
                                    kembali.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="koleksi" class="border-b border-[#e0d9c8]/80 bg-white/70">
            <div class="mx-auto w-full max-w-7xl px-6 py-16">
                <div class="max-w-3xl">

                    <h2 class="text-3xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">
                        Katalog publik Bibliotech menampilkan buku dengan informasi stok dan kategori secara langsung.
                    </h2>
                    <p class="mt-4 text-sm leading-relaxed text-[#4c5b54]">
                        Kami menggabungkan workflow administrasi dengan sentuhan editorial agar koleksi terasa hidup dan
                        terkurasi.
                    </p>
                </div>

                <div class="mt-10 grid gap-6 lg:grid-cols-2">

                    @forelse ($books as $book)
                        <article
                            class="group relative flex flex-col gap-6 overflow-hidden rounded-[2.5rem] border border-[#dcd2bd] bg-white/85 p-6 shadow-[0_25px_70px_-40px_rgba(15,87,82,0.45)] transition hover:-translate-y-1 hover:shadow-[0_35px_90px_-45px_rgba(15,87,82,0.55)]">
                            <div class="flex flex-col gap-6 md:flex-row">
                                <div
                                    class="aspect-[3/4] w-full max-w-[180px] overflow-hidden rounded-[1.75rem] border border-[#eaddc2] bg-[#f6ecda] shadow-sm md:w-40">
                                    @if ($book->cover_image_path)
                                        <img src="{{ asset('storage/' . $book->cover_image_path) }}"
                                            alt="Sampul {{ $book->title }}"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]" />
                                    @else
                                        <div
                                            class="flex h-full w-full items-center justify-center text-xs font-semibold uppercase tracking-[0.3em] text-[#b69c74]">
                                            Tanpa Sampul
                                        </div>
                                    @endif
                                </div>
                                <div class="flex flex-1 flex-col justify-between gap-4">
                                    <div class="space-y-3">
                                        <div class="flex items-start justify-between gap-3">
                                            <span
                                                class="inline-flex items-center gap-2 rounded-full bg-[#0f766e]/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-[#0f766e]">
                                                <span class="material-symbols-rounded text-sm">category</span>
                                                {{ $book->category }}
                                            </span>
                                            <span
                                                class="inline-flex items-center gap-1 text-[11px] uppercase tracking-[0.35em] text-[#a89f8d]">
                                                <span
                                                    class="material-symbols-rounded text-base text-[#f97316]">schedule</span>
                                                {{ optional($book->updated_at)->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-semibold text-[#172a37]"
                                                style="font-family: 'Space Grotesk', sans-serif;">{{ $book->title }}</h3>
                                            <p class="mt-1 text-sm font-medium text-[#6b766f]">
                                                {{ $book->author ?? 'Penulis tidak diketahui' }}
                                            </p>
                                        </div>
                                        <p class="text-sm leading-relaxed text-[#4c5b54]">
                                            {{ \Illuminate\Support\Str::limit($book->description, 200) }}
                                        </p>
                                    </div>

                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                        <div class="flex flex-col gap-2 sm:flex-row">
                                            <a href="{{ route('landing.books.show', $book) }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-full border border-[#0f766e]/30 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/10">
                                                <span class="material-symbols-rounded text-base">stylus_note</span>
                                                Ringkasan
                                            </a>
                                            @auth
                                                @if (auth()->user()->isStudent())
                                                    <a href="{{ route('student.books.show', $book) }}"
                                                        class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f766e] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                                                        <span class="material-symbols-rounded text-base">library_add</span>
                                                        Pinjam
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.books.edit', $book) }}"
                                                        class="inline-flex items-center justify-center gap-2 rounded-full bg-[#f97316] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#ea580c]">
                                                        <span class="material-symbols-rounded text-base">edit</span>
                                                        Kelola
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('student.books.show', $book) }}"
                                                    class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f766e] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                                                    <span class="material-symbols-rounded text-base">login</span>
                                                    Pinjam
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div
                            class="rounded-[2.5rem] border border-dashed border-[#dcd2bd] bg-white/60 p-12 text-center text-sm text-[#4c5b54]">
                            Koleksi belum tersedia. Kembali lagi untuk melihat buku terbaru yang sedang kami kurasi.
                        </div>
                    @endforelse
                </div>

                <div class="mt-10 flex justify-center">
                    <nav class="flex items-center gap-2">
                        <!-- Previous button -->
                        @if ($books->onFirstPage())
                            <span
                                class="inline-flex items-center justify-center rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500 cursor-not-allowed">
                                <span class="material-symbols-rounded text-base">chevron_left</span>
                            </span>
                        @else
                            <a href="{{ $books->previousPageUrl() }}"
                                class="inline-flex items-center justify-center rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#115e59]">
                                <span class="material-symbols-rounded text-base">chevron_left</span>
                            </a>
                        @endif

                        <!-- Page numbers -->
                        @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                            @if ($page == $books->currentPage())
                                <span
                                    class="inline-flex items-center justify-center rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="inline-flex items-center justify-center rounded-full bg-[#dcd2bd] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        <!-- Next button -->
                        @if ($books->hasMorePages())
                            <a href="{{ $books->nextPageUrl() }}"
                                class="inline-flex items-center justify-center rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#115e59]">
                                <span class="material-symbols-rounded text-base">chevron_right</span>
                            </a>
                        @else
                            <span
                                class="inline-flex items-center justify-center rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500 cursor-not-allowed">
                                <span class="material-symbols-rounded text-base">chevron_right</span>
                            </span>
                        @endif
                    </nav>
                </div>
                <a href="#discover"
                    class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#0f766e] transition hover:text-[#115e59]">
                    <span class="material-symbols-rounded text-sm">north_east</span>
                    Kembali ke pencarian
                </a>
            </div>
        </section>

        <section id="koleksi" class="bg-transparent">
            <div class="mx-auto w-full max-w-7xl px-6 py-16">
                <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                    <div>
                        <h2 class="text-3xl font-semibold text-[#172a37]"
                            style="font-family: 'Space Grotesk', sans-serif;">Koleksi terbaru yang siap dipinjam</h2>
                        <p class="mt-2 text-sm text-[#4c5b54]">Katalog publik Bibliotech menampilkan buku dengan
                            informasi stok dan kategori secara langsung.</p>
                    </div>

                </div>




            </div>
        </section>

        <section class="border-y border-[#e0d9c8]/80 bg-[#0f766e]">
            <div class="mx-auto w-full max-w-7xl px-6 py-16">
                <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                    <div class="space-y-4 text-white">
                        <h2 class="text-3xl font-semibold leading-tight"
                            style="font-family: 'Space Grotesk', sans-serif;">
                            Transformasi ruang baca sekolah dimulai dari cara kita mempersembahkan koleksi.
                        </h2>
                        <p class="text-sm text-white/80">
                            Bibliotech memadukan katalog, peminjaman, dan pengelolaan stok ke dalam satu pengalaman yang
                            konsisten tanpa meninggalkan kehangatan perpustakaan konvensional.
                        </p>
                    </div>
                    <div
                        class="flex flex-col gap-3 rounded-[2.5rem] border border-white/30 bg-white/10 p-6 text-sm text-white/85">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-rounded text-base text-[#fde68a]">emoji_objects</span>
                            <p>Susun pameran buku tematik dengan mudah dan hadirkan pengalaman literasi yang lebih
                                imersif.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-rounded text-base text-[#fde68a]">how_to_reg</span>
                            <p>Pendaftaran akun fleksibel untuk guru, pustakawan, maupun siswa dengan akses yang
                                relevan.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-rounded text-base text-[#fde68a]">view_quilt</span>
                            <p>Dashboard bersifat modular dan dapat beradaptasi dengan kebijakan peminjaman sekolah.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex flex-wrap items-center justify-between gap-4 text-sm text-white/70">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/40 px-4 py-2">
                        <span class="material-symbols-rounded text-base text-white">fingerprint</span>
                        Login aman dengan validasi token CSRF
                    </div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/40 px-4 py-2">
                        <span class="material-symbols-rounded text-base text-white">lock_open</span>
                        Transparan untuk publik, privat untuk transaksi
                    </div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/40 px-4 py-2">
                        <span class="material-symbols-rounded text-base text-white">insights</span>
                        Statistik real-time untuk perencanaan literasi
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-[#e0d9c8] bg-white/80 py-6">
        <div
            class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-6 text-xs text-[#4c5b54] md:flex-row">
            <p>&copy; {{ now()->year }} Bibliotech. Proyek Web Programming XI RPL 2025/2026.</p>
            <p class="flex items-center gap-2">
                <span class="material-symbols-rounded text-sm text-[#0f766e]">code</span>
                Laravel 12 • TailwindCSS • Breeze
            </p>
        </div>
    </footer>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('logoutModal');
        const trigger = document.getElementById('logoutTrigger');
        const cancel = document.getElementById('cancelLogout');
        const content = modal.querySelector('div');

        // animasi modal logout
        trigger.addEventListener('click', () => {
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.add('opacity-100', 'scale-100');
                content.classList.remove('opacity-0', 'scale-90');
            }, 10);
        });

        cancel.addEventListener('click', () => {
            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-90');
            setTimeout(() => modal.classList.add('hidden'), 250);
        });

        // 🌤️ cinematic fade-in
        const body = document.querySelector('body');
        setTimeout(() => {
            body.classList.remove('opacity-0', 'blur-sm', 'scale-[1.02]');
            body.classList.add('opacity-100', 'blur-0', 'scale-100');
        }, 100);
    });
</script>

</html>