<x-app-layout>
    <x-slot name="pageHeading">
        {{ $book->title }}
    </x-slot>

    <x-slot name="pageDescription">
        Ajukan peminjaman dengan mengisi formulir di samping. Stok tersedia: {{ $book->quantity }} buku.
    </x-slot>

    <div class="grid gap-8 lg:grid-cols-[1.2fr_1fr]">
        <div class="space-y-6 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <div class="relative overflow-hidden rounded-[2.5rem]">
                @if ($book->cover_image_path)
                    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="{{ $book->title }}" class="w-full rounded-[2.5rem] object-cover shadow-lg" />
                @else
                    <div class="flex h-80 w-full items-center justify-center rounded-[2.5rem] bg-[#f6ecda] text-sm font-semibold uppercase tracking-[0.3em] text-[#b69c74]">Belum ada gambar</div>
                @endif
                <div class="absolute top-4 left-4 inline-flex items-center gap-2 rounded-full border border-white/40 bg-white/20 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white">
                    {{ $book->category }}
                </div>
            </div>

            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 rounded-full bg-[#0f766e]/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#0f766e]">
                    <span class="material-symbols-rounded text-sm">person</span>
                    {{ $book->author ?? 'Penulis tidak diketahui' }}
                </div>
                <p class="text-sm leading-relaxed text-[#4c5b54]">{{ $book->description }}</p>
            </div>

            <div class="rounded-[1.75rem] text-center border border-[#dcd2bd] bg-[#fdf4e3] px-4 py-3 text-xs text-[#5f6b63]">
                Peringatan !! <br>Waktu peminjaman maksimal 14 hari. Pastikan mengembalikan tepat waktu agar akunmu tetap aktif.
            </div>
        </div>

        <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <h3 class="text-lg font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">Formulir Peminjaman</h3>
            <p class="mt-1 text-sm text-[#4c5b54]">Lengkapi data berikut untuk mengajukan peminjaman buku.</p>

            <form method="POST" action="{{ route('student.books.borrow', $book) }}" class="mt-6 space-y-5">
                @csrf

                @if ($book->quantity < 1)
                    <div class="rounded-[1.75rem] border border-[#be123c]/40 bg-[#be123c]/10 px-4 py-3 text-sm font-semibold uppercase tracking-[0.3em] text-[#881337]">
                        Stok buku sedang kosong. Silakan pilih buku lain atau hubungi admin perpustakaan.
                    </div>
                @endif

                <div>
                    <label for="borrower_name" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Nama Peminjam</label>
                    <input type="text" id="borrower_name" name="borrower_name" value="{{ old('borrower_name', auth()->user()->name) }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                    <x-input-error :messages="$errors->get('borrower_name')" class="mt-2" />
                </div>

                <div>
                    <label for="quantity" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah Buku</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', min(1, $book->quantity)) }}" min="1" max="{{ max(1, $book->quantity) }}" @if($book->quantity < 1) disabled @endif required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20 disabled:cursor-not-allowed disabled:bg-[#f6f1e8]" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="borrowed_at" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Tanggal Pinjam</label>
                        <input type="date" id="borrowed_at" name="borrowed_at" value="{{ old('borrowed_at', now()->toDateString()) }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                        <x-input-error :messages="$errors->get('borrowed_at')" class="mt-2" />
                    </div>
                    <div>
                        <label for="return_date" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Tanggal Kembali</label>
                        <input type="date" id="return_date" name="return_date" value="{{ old('return_date', now()->addDays(7)->toDateString()) }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                        <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <label for="notes" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Catatan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="3" class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" placeholder="Contoh: diperlukan untuk tugas mata pelajaran ...">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#0f766e] px-5 py-3 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59] disabled:cursor-not-allowed disabled:bg-[#b3c0b9]" @if($book->quantity < 1) disabled @endif>
                    <span class="material-symbols-rounded text-base">bookmark_add</span>
                    Kirim Permintaan Peminjaman
                </button>

                <a href="{{ route('student.books.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-[#dcd2bd] px-5 py-3 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Kembali ke Katalog
                </a>
            </form>
        </div>
    </div>
</x-app-layout>
