<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Masuk | Bibliotheck' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@300;400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative min-h-screen overflow-hidden bg-[#f6f1e8] text-[#24323f] antialiased" style="font-family: 'Inter', sans-serif;">
    <div class="pointer-events-none fixed inset-0 overflow-hidden">
        <div class="absolute -top-40 left-0 h-96 w-96 -translate-x-1/3 rounded-full bg-[#0f766e]/20 blur-3xl"></div>
        <div class="absolute top-32 right-0 h-[30rem] w-[30rem] translate-x-1/4 rounded-full bg-[#f4bb7a]/35 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 h-[20rem] w-[20rem] -translate-x-1/2 translate-y-24 rounded-full bg-[#fde68a]/35 blur-3xl"></div>
    </div>

    <div class="relative z-10 flex min-h-screen items-center justify-center px-6 py-12">
        <div class="grid w-full max-w-6xl gap-10 rounded-[3rem] border border-[#dcd2bd] bg-white/75 p-8 shadow-[0_35px_90px_-40px_rgba(15,87,82,0.55)] backdrop-blur md:grid-cols-[1.1fr_0.9fr]">
            <div class="hidden flex-col justify-between rounded-[2.5rem] border border-[#dcd2bd] bg-[#fff7ec] p-10 md:flex">
                <div class="space-y-6">
                    <span class="inline-flex items-center gap-2 rounded-full border border-[#f4bb7a] bg-white/80 px-4 py-1 text-xs font-semibold uppercase tracking-[0.35em] text-[#b95d23]">
                        <span class="material-symbols-rounded text-sm">auto_stories</span>
                        Bibliotheck
                    </span>
                    <h1 class="text-4xl font-semibold leading-tight text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">
                        Sistem perpustakaan sekolah yang dirancang ulang untuk kolaborasi dan kurasi.
                    </h1>
                    <p class="text-sm leading-relaxed text-[#4c5b54]">
                        Kelola arsip buku, pantau peminjaman, dan hadirkan rekomendasi koleksi dengan visual yang lebih hangat dan terarah.
                    </p>
                </div>

                <div class="mt-10 space-y-5 text-sm text-[#4c5b54]">
                    <div class="flex items-start gap-3 rounded-[1.75rem] border border-[#f4bb7a]/40 bg-white/80 px-4 py-3">
                        <span class="material-symbols-rounded text-base text-[#f97316]">hub</span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[#b95d23]">Untuk admin</p>
                            <p class="mt-1">Sinkronisasi data stok, peminjaman, dan pengembalian buku tanpa spreadsheet tambahan.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 rounded-[1.75rem] border border-[#0f766e]/40 bg-[#0f766e]/10 px-4 py-3">
                        <span class="material-symbols-rounded text-base text-[#0f766e]">bookmark_added</span>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[#0f766e]">Untuk siswa</p>
                            <p class="mt-1">Temukan buku favoritmu, baca sinopsis, dan ajukan peminjaman dalam satu alur.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2 rounded-full border border-[#dcd2bd] bg-white/80 px-4 py-2 text-xs font-semibold uppercase tracking-[0.35em] text-[#6b766f]">
                    <span class="material-symbols-rounded text-base text-[#0f766e]">verified_user</span>
                    Enkripsi CSRF & validasi kredensial
                </div>
            </div>

            <div class="flex flex-col gap-6 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
                <div class="flex items-center gap-3">
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#0f766e]/10 text-[#0f766e]">
                        <span class="material-symbols-rounded text-2xl">lock</span>
                    </span>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.35em] text-[#6b766f]">Portal aman</p>
                        <h2 class="text-xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">
                            Masuk ke Bibliotheck
                        </h2>
                    </div>
                </div>

                <div class="space-y-2 text-sm text-[#4c5b54]">
                    <p>Gunakan akun admin atau siswa yang telah terdaftar untuk mengakses katalog internal.</p>
                    <p class="text-xs text-[#9aa29a]">Belum punya akun? Hubungi petugas perpustakaan sekolah.</p>
                </div>

                <div class="space-y-6">
                    {{ $slot }}
                </div>

                <p class="pt-6 text-center text-xs text-[#9aa29a]">
                    &copy; {{ now()->year }} Bibliotheck • Sistem Peminjaman Buku berbasis Digital
                </p>
            </div>
        </div>
    </div>
</body>

</html>
