<x-app-layout>
    <x-slot name="pageHeading">
        Tambah Buku Baru
    </x-slot>

    <x-slot name="pageDescription">
        Lengkapi detail koleksi agar siswa mudah menemukan bacaan mereka.
    </x-slot>

    <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="grid gap-6 md:grid-cols-2">
            @csrf

            <div class="md:col-span-2">
                <label for="title" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Judul Buku</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" placeholder="Misal: Belajar Laravel Modern" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
                <label for="author" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Penulis</label>
                <input type="text" id="author" name="author" value="{{ old('author') }}" class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" placeholder="Nama penulis" />
                <x-input-error :messages="$errors->get('author')" class="mt-2" />
            </div>

            <div>
                <label for="category" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kategori</label>
                <div class="relative mt-2">
                    <select id="category" name="category" required class="w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 pr-10 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20 appearance-none">
                        <option value="" disabled selected>Pilih kategori</option>
                        <option value="Teknologi" {{ old('category') === 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                        <option value="Sains" {{ old('category') === 'Sains' ? 'selected' : '' }}>Sains</option>
                        <option value="Bisnis" {{ old('category') === 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                        <option value="Seni" {{ old('category') === 'Seni' ? 'selected' : '' }}>Seni</option>
                        <option value="Sejarah" {{ old('category') === 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                        <option value="Fiksi" {{ old('category') === 'Fiksi' ? 'selected' : '' }}>Fiksi</option>
                        <option value="Non-Fiksi" {{ old('category') === 'Non-Fiksi' ? 'selected' : '' }}>Non-Fiksi</option>
                        <option value="Anak-anak" {{ old('category') === 'Anak-anak' ? 'selected' : '' }}>Anak-anak</option>
                        <option value="Pendidikan" {{ old('category') === 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Agama" {{ old('category') === 'Agama' ? 'selected' : '' }}>Agama</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#4c5b54]">
                        <span class="material-symbols-rounded">expand_more</span>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <div>
                <label for="quantity" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah Stok</label>
                <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="0" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <div class="md:col-span-2">
                <label for="cover" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Gambar Sampul</label>
                <div class="mt-2 grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <input type="file" id="cover" name="cover" accept="image/*" required class="w-full rounded-[1.75rem] border border-dashed border-[#d5c7a8] bg-[#fdf4e3] px-4 py-5 text-sm text-[#4c5b54] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                        <p class="mt-2 text-xs text-[#9aa29a]">Format jpeg, png. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('cover')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="relative w-32 h-40 overflow-hidden rounded-[1.25rem] border border-[#eaddc2] bg-[#f6ecda] flex items-center justify-center">
                            <img id="preview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='192' viewBox='0 0 128 192'%3E%3Crect width='128' height='192' fill='%23f6ecda'/%3E%3C/svg%3E" alt="Preview Sampul Buku" class="w-full h-full object-cover opacity-70" />
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-200">
                                <div class="bg-white/80 rounded-full p-2">
                                    <span class="material-symbols-rounded text-[#172a37]">image</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label for="description" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Deskripsi Buku</label>
                <textarea id="description" name="description" rows="5" required class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" placeholder="Ceritakan ringkasan menarik mengenai isi buku...">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="md:col-span-2 flex items-center justify-end gap-3">
                <a href="{{ route('admin.books.index') }}" class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-4 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                    <span class="material-symbols-rounded text-base">arrow_back</span>
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-5 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                    <span class="material-symbols-rounded text-base">save</span>
                    Simpan Buku
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('cover').addEventListener('change', function(e) {
            const [file] = e.target.files;
            const preview = document.getElementById('preview');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('opacity-70');
                }
                
                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file, kembalikan ke placeholder
                preview.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='192' viewBox='0 0 128 192'%3E%3Crect width='128' height='192' fill='%23f6ecda'/%3E%3C/svg%3E";
                preview.classList.add('opacity-70');
            }
        });
    </script>
</x-app-layout>
