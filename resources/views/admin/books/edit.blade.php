<x-app-layout>
    <x-slot name="pageHeading">
        Edit Buku
    </x-slot>

    <x-slot name="pageDescription">
        Perbarui informasi <span class="font-semibold">{{ $book->title }}</span> agar katalog Bibliotheck selalu akurat.
    </x-slot>

    <div class="grid gap-8 md:grid-cols-[1fr_1.2fr]">
        <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/85 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <div class="relative aspect-[3/4] overflow-hidden rounded-[2rem] border border-[#eaddc2] bg-[#f6ecda] group">
                @if ($book->cover_image_path)
                    <img id="currentCover" src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                @else
                    <img id="currentCover" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='192' viewBox='0 0 128 192'%3E%3Crect width='128' height='192' fill='%23f6ecda'/%3E%3C/svg%3E" alt="Preview Sampul Buku" class="w-full h-full object-cover opacity-70" />
                @endif
                <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                    <button type="button" id="changeCoverBtn" class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-4 py-2 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#115e59]">
                        <span class="material-symbols-rounded text-base">edit</span>
                        Ganti Sampul
                    </button>
                </div>
            </div>
            <input type="file" id="cover" name="cover" accept="image/*" class="hidden" />
            <p class="mt-4 text-xs text-[#9aa29a] text-center">Klik tombol "Ganti Sampul" di atas untuk mengubah gambar</p>
            <x-input-error :messages="$errors->get('cover')" class="mt-2" />
        </div>

        <div class="space-y-6 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <header class="space-y-2 mb-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-3xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">Edit Buku</h2>
                        <span class="inline-flex items-center gap-2 rounded-full bg-[#dcfce7] px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#166534]">
                            Stok {{ $book->quantity }}
                        </span>
                    </div>
                </header>

                <div class="grid gap-6">
                    <div>
                        <label for="title" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Judul Buku</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="author" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Penulis</label>
                            <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                            <x-input-error :messages="$errors->get('author')" class="mt-2" />
                        </div>

                        <div>
                            <label for="category" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kategori</label>
                            <input type="text" id="category" name="category" value="{{ old('category', $book->category) }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <label for="quantity" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah Stok</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <div>
                        <label for="description" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Deskripsi Buku</label>
                        <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">{{ old('description', $book->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4">
                        <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-4 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                            <span class="material-symbols-rounded text-base">arrow_back</span>
                            Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-5 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                            <span class="material-symbols-rounded text-base">save</span>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk mengganti gambar saat dipilih
        document.getElementById('cover').addEventListener('change', function(e) {
            const [file] = e.target.files;
            const currentCover = document.getElementById('currentCover');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    currentCover.src = e.target.result;
                    // Hapus kelas opacity-70 jika sebelumnya tidak ada gambar
                    currentCover.classList.remove('opacity-70');
                }
                
                reader.readAsDataURL(file);
            }
        });
        
        // Fungsi untuk men-trigger input file saat tombol diklik
        document.getElementById('changeCoverBtn').addEventListener('click', function() {
            document.getElementById('cover').click();
        });
    </script>
</x-app-layout>
