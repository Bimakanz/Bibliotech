<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} | Bibliotheck</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen bg-[#f6f1e8] text-[#24323f] antialiased" style="font-family: 'Inter', sans-serif;">
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-32 right-0 h-[20rem] w-[20rem] translate-x-1/4 rounded-full bg-[#0f766e]/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 h-[26rem] w-[26rem] -translate-x-1/4 translate-y-20 rounded-full bg-[#f4bb7a]/35 blur-3xl"></div>
    </div>

    <header class="relative border-b border-[#e0d9c8] bg-white/80 backdrop-blur">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6 px-6 py-5">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#115e59] text-lg font-semibold text-white shadow-sm">B</span>
                <div>
                    <p class="text-lg font-semibold tracking-tight" style="font-family: 'Space Grotesk', sans-serif;">Bibliotheck</p>
                    <p class="text-xs uppercase tracking-[0.35em] text-[#5f6b63]">School Library</p>
                </div>
            </a>
            <nav class="hidden items-center gap-4 text-sm text-[#4c5b54] md:flex">
                <a href="{{ route('landing') }}#discover" class="rounded-full px-4 py-2 transition hover:bg-[#0f766e]/10 hover:text-[#0f766e]">Beranda</a>
                <a href="{{ route('landing') }}#koleksi" class="rounded-full px-4 py-2 transition hover:bg-[#0f766e]/10 hover:text-[#0f766e]">Koleksi</a>
            </nav>
            <div class="flex items-center gap-3 text-sm">
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.books.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/30 bg-[#0f766e]/10 px-4 py-2 font-semibold text-[#0f766e] transition hover:border-[#0f766e]/50 hover:bg-[#0f766e]/20">
                        <span class="material-symbols-rounded text-base">space_dashboard</span>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/30 px-4 py-2 font-semibold text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/10">
                        <span class="material-symbols-rounded text-base">login</span>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-full bg-[#f97316] px-4 py-2 font-semibold text-white shadow-sm transition hover:bg-[#ea580c]">
                        <span class="material-symbols-rounded text-base">person_add</span>
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="relative z-10 flex-1 pb-16">
        <section class="mx-auto w-full max-w-7xl px-6 pt-20 pb-16">
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.35em] text-[#6b766f]">
                <a href="{{ route('landing') }}" class="inline-flex items-center gap-1 text-[#0f766e] transition hover:text-[#115e59]">
                    <span class="material-symbols-rounded text-base">home</span>
                    Beranda
                </a>
                <span class="material-symbols-rounded text-base text-[#c4b89d]">chevron_right</span>
                <span>Koleksi</span>
                <span class="material-symbols-rounded text-base text-[#c4b89d]">chevron_right</span>
                <span class="text-[#172a37]">{{ $book->title }}</span>
            </div>

            <div class="mt-12 grid gap-12 lg:grid-cols-[0.9fr_1.1fr]">
                <aside class="space-y-6">
                    <div class="overflow-hidden rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_25px_70px_-40px_rgba(15,87,82,0.45)]">
                        <div class="aspect-[3/4] overflow-hidden rounded-[2rem] border border-[#eaddc2] bg-[#f6ecda]">
                            @if ($book->cover_image_path)
                                <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                            @else
                                <div class="flex h-full w-full items-center justify-center text-xs font-semibold uppercase tracking-[0.35em] text-[#b69c74]">
                                    Tidak ada sampul
                                </div>
                            @endif
                        </div>
                        <div class="mt-6 flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#b69c74]">
                            <span class="inline-flex items-center gap-2 rounded-full bg-[#0f766e]/10 px-3 py-1 text-[#0f766e]">
                                <span class="material-symbols-rounded text-sm">category</span>
                                {{ $book->category }}
                            </span>
                            <span class="inline-flex items-center gap-2 rounded-full bg-[#dcfce7] px-3 py-1 text-[#166534]">
                                <span class="material-symbols-rounded text-sm">inventory_2</span>
                                Stok {{ $book->quantity }}
                            </span>
                        </div>

                        <div class="mt-6 space-y-3 text-sm text-[#4c5b54]">
                            <div class="flex items-start gap-3 rounded-[1.75rem] border border-[#eaddc2] bg-white px-4 py-3">
                                <span class="material-symbols-rounded text-base text-[#f97316]">schedule</span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[#a89f8d]">Diperbarui</p>
                                    <p class="text-sm text-[#172a37]">{{ optional($book->updated_at)->translatedFormat('d M Y H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 rounded-[1.75rem] border border-[#eaddc2] bg-white px-4 py-3">
                                <span class="material-symbols-rounded text-base text-[#f97316]">calendar_today</span>
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[#a89f8d]">Ditambahkan</p>
                                    <p class="text-sm text-[#172a37]">{{ optional($book->created_at)->translatedFormat('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            @auth
                                @if (auth()->user()->isStudent())
                                    <a href="{{ route('student.books.show', $book) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-[1.75rem] bg-[#0f766e] px-5 py-3 text-sm font-semibold uppercase tracking-[0.35em] text-white transition hover:bg-[#115e59]">
                                        <span class="material-symbols-rounded text-base">library_add</span>
                                        Pinjam Buku
                                    </a>
                                @else
                                    <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-[1.75rem] bg-[#f97316] px-5 py-3 text-sm font-semibold uppercase tracking-[0.35em] text-white transition hover:bg-[#ea580c]">
                                        <span class="material-symbols-rounded text-base">edit</span>
                                        Kelola Data
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-[1.75rem] border border-[#0f766e]/40 bg-[#0f766e]/10 px-5 py-3 text-sm font-semibold uppercase tracking-[0.35em] text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/20">
                                    <span class="material-symbols-rounded text-base">login</span>
                                    Masuk untuk Meminjam
                                </a>
                            @endauth

                            <a href="{{ route('landing') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-[1.75rem] border border-[#dcd2bd] px-5 py-3 text-sm font-semibold uppercase tracking-[0.35em] text-[#4c5b54] transition hover:border-[#0f766e]/30 hover:text-[#0f766e]">
                                <span class="material-symbols-rounded text-base">arrow_back</span>
                                Kembali ke katalog
                            </a>
                        </div>
                    </div>
                </aside>

                <article class="space-y-10 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-40px_rgba(15,87,82,0.45)]">
                    <header class="space-y-4">
                        <span class="inline-flex items-center gap-2 rounded-full border border-[#f4bb7a] bg-[#fff1dc] px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#b95d23]">
                            <span class="material-symbols-rounded text-sm">auto_stories</span>
                            Koleksi Pilihan
                        </span>
                        <h1 class="text-4xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">{{ $book->title }}</h1>
                        <p class="text-sm font-medium uppercase tracking-[0.3em] text-[#6b766f]">
                            {{ $book->author ?? 'Penulis tidak diketahui' }}
                        </p>
                    </header>

                    <section class="space-y-4 text-sm leading-relaxed text-[#4c5b54]">
                        @if ($book->description)
                            <p>{{ $book->description }}</p>
                        @else
                            <p class="italic text-[#9aa29a]">Belum ada deskripsi yang ditambahkan untuk buku ini. Hubungi admin perpustakaan untuk memperbarui informasi.</p>
                        @endif
                    </section>

                    <section class="grid gap-6 md:grid-cols-2">
                        <div class="rounded-[1.75rem] border border-[#eaddc2] bg-white px-5 py-4">
                            <h2 class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Status Peminjaman</h2>
                            <div class="mt-3 flex items-center gap-2 text-sm text-[#172a37]">
                                <span class="material-symbols-rounded text-base text-[#0f766e]">track_changes</span>
                                {{ $book->quantity > 0 ? 'Buku masih tersedia untuk kamu pinjam.' : 'Stok habis untuk sementara waktu.' }}
                            </div>
                        </div>
                        <div class="rounded-[1.75rem] border border-[#eaddc2] bg-white px-5 py-4">
                            <h2 class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Identitas Koleksi</h2>
                            <div class="mt-3 space-y-2 text-sm text-[#4c5b54]">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-rounded text-base text-[#f97316]">sell</span>
                                    {{ $book->category ?? 'Kategori belum diatur' }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-rounded text-base text-[#f97316]">barcode</span>
                                    ID Buku: {{ $book->id }}
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="space-y-3 rounded-[1.75rem] border border-[#0f766e]/20 bg-[#0f766e]/5 px-5 py-4 text-sm text-[#1c2d2f]">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-rounded text-base text-[#0f766e]">tips_and_updates</span>
                            <p>
                                Ingin membantu memperkaya deskripsi atau menambahkan ulasan singkat? Silakan hubungi admin perpustakaan agar catatan baca kamu dapat ditampilkan di Bibliotheck.
                            </p>
                        </div>
                    </section>
                </article>
            </div>
        </section>
    </main>

    <footer class="border-t border-[#e0d9c8] bg-white/80 py-6">
        <div class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-3 px-6 text-xs text-[#4c5b54] md:flex-row">
            <p>&copy; {{ now()->year }} Bibliotheck.</p>
            <p class="flex items-center gap-2">
                <span class="material-symbols-rounded text-sm text-[#0f766e]">code</span>
                Laravel 12 • TailwindCSS • Breeze
            </p>
        </div>
    </footer>
</body>

</html>
