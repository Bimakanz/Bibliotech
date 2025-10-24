<x-app-layout>
    <x-slot name="pageHeading">
        Detail Buku
    </x-slot>

    <x-slot name="pageDescription">
        Informasi lengkap untuk koleksi <span class="font-semibold">{{ $book->title }}</span>.
    </x-slot>

    <div class="grid gap-8 md:grid-cols-[1fr_1.2fr]">
        <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/85 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <div class="aspect-[3/4] overflow-hidden rounded-[2rem] border border-[#eaddc2] bg-[#f6ecda]">
                @if ($book->cover_image_path)
                    <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                @else
                    <div class="flex h-full w-full items-center justify-center text-sm font-semibold uppercase tracking-[0.3em] text-[#b69c74]">
                        Belum ada sampul
                    </div>
                @endif
            </div>
            <div class="mt-6 flex items-center justify-between">
                <span class="inline-flex items-center gap-2 rounded-full bg-[#dcfce7] px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#166534]">
                    Stok {{ $book->quantity }}
                </span>
                <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/40 bg-[#0f766e]/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.3em] text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/20">
                    <span class="material-symbols-rounded text-base">edit</span>
                    Edit
                </a>
            </div>
        </div>

        <div class="space-y-6 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <header class="space-y-2">
                <h2 class="text-3xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">{{ $book->title }}</h2>
                <p class="text-sm uppercase tracking-[0.3em] text-[#6b766f]">Karya {{ $book->author ?? 'Penulis tidak diketahui' }}</p>
            </header>

            <div class="grid gap-4 md:grid-cols-2 text-sm text-[#4c5b54]">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Kategori</p>
                    <p class="mt-1 font-medium text-[#0f766e]">{{ $book->category }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Slug</p>
                    <p class="mt-1 font-mono text-xs text-[#5f6b63]">{{ $book->slug }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Ditambahkan</p>
                    <p class="mt-1">{{ $book->created_at->translatedFormat('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Pembaruan Terakhir</p>
                    <p class="mt-1">{{ $book->updated_at->translatedFormat('d M Y H:i') }}</p>
                </div>
            </div>

            <section class="space-y-2">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-[#a89f8d]">Deskripsi</p>
                <p class="leading-relaxed text-[#4c5b54]">{{ $book->description }}</p>
            </section>

            <div class="flex items-center gap-3">
                <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-4 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Kembali
                </a>
                <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-[#be123c] px-5 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#991b1b]">
                        <span class="material-symbols-rounded text-base">delete</span>
                        Hapus Buku
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
