<x-app-layout>
    <x-slot name="pageHeading">
        Jelajahi Koleksi Buku
    </x-slot>

    <x-slot name="pageDescription">
        Temukan buku favoritmu dan ajukan peminjaman secara daring.
    </x-slot>

    <form method="GET" class="grid gap-4 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)] md:grid-cols-[1fr_auto] md:items-end">
        <div>
            <label for="q" class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Cari Judul / Penulis</label>
            <div class="mt-2 flex items-center gap-3 rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-2.5 shadow-sm focus-within:border-[#0f766e] focus-within:ring-2 focus-within:ring-[#0f766e]/20">
                <span class="material-symbols-rounded text-[#9aa29a]">search</span>
                <input id="q" type="text" name="q" value="{{ $search }}" placeholder="Masukkan kata kunci" class="w-full border-0 bg-transparent text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:ring-0" />
            </div>
        </div>
        <div class="grid gap-3 md:grid-cols-2 md:items-center">
            <div>
                <label for="category" class="text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kategori</label>
                <select id="category" name="category" class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-2.5 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item }}" @selected($item === $category)>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f766e] px-5 py-3 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                <span class="material-symbols-rounded text-base">filter_alt</span>
                Terapkan Filter
            </button>
        </div>
    </form>

    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($books as $book)
            <article class="group rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)] transition hover:-translate-y-1 hover:shadow-[0_30px_80px_-45px_rgba(15,87,82,0.55)]">
                <div class="relative h-56 overflow-hidden rounded-t-[2.5rem]">
                    @if ($book->cover_image_path)
                        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="{{ $book->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-[#f6ecda] text-sm font-semibold uppercase tracking-[0.3em] text-[#b69c74]">
                            Belum ada gambar
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#172a37]/75 via-[#172a37]/10 to-transparent"></div>
                    <div class="absolute left-4 bottom-4 text-white">
                        <span class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em]">{{ $book->category }}</span>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">{{ $book->title }}</h3>
                        <p class="text-xs uppercase tracking-[0.3em] text-[#6b766f]">{{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                    </div>
                    <p class="text-sm leading-relaxed text-[#4c5b54]">{{ \Illuminate\Support\Str::limit($book->description, 140) }}</p>
                    <div class="flex items-center justify-between text-xs text-[#4c5b54]">
                        <span class="inline-flex items-center gap-2 rounded-full bg-[#dcfce7] px-3 py-1 font-semibold uppercase tracking-[0.3em] text-[#166534]">Stok {{ $book->quantity }}</span>
                        <a href="{{ route('student.books.show', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/40 px-3 py-1 font-semibold uppercase tracking-[0.3em] text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/10">
                            <span class="material-symbols-rounded text-base">open_in_new</span>
                            Ajukan Pinjam
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-[2.5rem] border border-dashed border-[#dcd2bd] bg-white/70 p-8 text-center text-sm text-[#4c5b54]">
                Tidak ada buku yang sesuai dengan pencarianmu.
            </div>
        @endforelse
    </div>

    <div>
        {{ $books->links() }}
    </div>
</x-app-layout>
