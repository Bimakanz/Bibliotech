<x-app-layout>
    <x-slot name="pageHeading">
        Edit Buku
    </x-slot>

    <x-slot name="pageDescription">
        Perbarui informasi <span class="font-semibold">{{ $book->title }}</span> agar katalog Bibliotheck selalu akurat.
    </x-slot>

    <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
        <form method="POST" action="{{ route('admin.books.update', $book) }}" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
            @csrf
            @method('PUT')

            <div class="md:col-span-2">
                <label for="title" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

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

            <div>
                <label for="quantity" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah Stok</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Sampul Saat Ini</label>
                        <div class="mt-2 flex items-center justify-center">
                            <div class="relative w-32 h-40 overflow-hidden rounded-[1.25rem] border border-[#eaddc2] bg-[#f6ecda] flex items-center justify-center">
                                @if ($book->cover_image_path)
                                    <img id="currentCover" src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="w-full h-full object-cover" />
                                @else
                                    <img id="currentCover" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='192' viewBox='0 0 128 192'%3E%3Crect width='128' height='192' fill='%23f6ecda'/%3E%3C/svg%3E" alt="Preview Sampul Buku" class="w-full h-full object-cover opacity-70" />
                                @endif
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200">
                                    <div class="bg-white/80 rounded-full p-2">
                                        <span class="material-symbols-rounded text-[#172a37]">image</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="cover" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Ganti Sampul</label>
                        <input type="file" id="cover" name="cover" accept="image/*" class="mt-2 w-full rounded-[1.75rem] border border-dashed border-[#d5c7a8] bg-[#fdf4e3] px-4 py-5 text-sm text-[#4c5b54] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                        <p class="mt-2 text-xs text-[#9aa29a]">Kosongkan jika tidak ingin mengubah gambar.</p>
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label for="description" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Deskripsi Buku</label>
                <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">{{ old('description', $book->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="md:col-span-2 flex items-center justify-end gap-3">
                <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-4 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Kembali
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-5 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                    <span class="material-symbols-rounded text-base">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('cover').addEventListener('change', function(e) {
            const [file] = e.target.files;
            const currentCover = document.getElementById('currentCover');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    currentCover.src = e.target.result;
                    currentCover.classList.remove('opacity-70');
                }
                
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
