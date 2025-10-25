<x-app-layout>
    <x-slot name="pageHeading">
        Tambah Buku Baru
    </x-slot>

    <x-slot name="pageDescription">
        Lengkapi detail koleksi agar siswa mudah menemukan bacaan mereka.
    </x-slot>

    <div class="grid gap-8 md:grid-cols-[1fr_1.2fr]">
        <!-- Bagian Gambar Sampul -->
<div class="flex flex-col items-center justify-center rounded-[2.5rem] border border-[#dcd2bd] bg-white/85 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
    <div class="relative aspect-[3/4] overflow-hidden rounded-[2rem] border border-[#eaddc2] bg-[#f6ecda] group 
                w-[85%] sm:w-[70%] md:w-[90%] lg:w-[85%] xl:w-[80%] 
                max-w-[420px] md:max-w-[500px] lg:max-w-[550px] 
                shadow-[0_15px_40px_rgba(0,0,0,0.1)] transition-transform duration-300 hover:scale-[1.01]">

        <img id="preview" 
            src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='192' viewBox='0 0 128 192'%3E%3Crect width='128' height='192' fill='%23f6ecda'/%3E%3C/svg%3E"
            alt="Preview Sampul Buku"
            class="w-full h-full object-cover object-center transition-transform duration-500 ease-out group-hover:scale-[1.03]" />

        <!-- Overlay upload -->
        <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <button type="button" id="changeCoverBtn"
                class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-5 py-2 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#115e59] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/40">
                <span class="material-symbols-rounded text-base">upload</span>
                Pilih Sampul
            </button>
        </div>
    </div>

    <p class="mt-5 text-xs sm:text-sm text-[#9aa29a] text-center leading-relaxed">
        Format: JPG, JPEG, atau PNG <br class="hidden sm:block" />
        Maksimal ukuran 2MB
    </p>
</div>




        <!-- Bagian Form Input -->
        <div class="space-y-6 rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-8 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="grid gap-6">
                @csrf

                <!-- input file SEKARANG ADA DI DALAM FORM -->
                <input type="file" id="cover" name="cover" accept="image/*" required class="hidden" />
                <x-input-error :messages="$errors->get('cover')" class="mt-2" />

                <header class="space-y-2 mb-4">
                    <h2 class="text-3xl font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">Tambah Buku</h2>
                </header>

                <div>
                    <label for="title" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Judul Buku</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20"
                        placeholder="Misal: Belajar Laravel Modern" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="author" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Penulis</label>
                        <input type="text" id="author" name="author" value="{{ old('author') }}"
                            class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20"
                            placeholder="Nama penulis" />
                        <x-input-error :messages="$errors->get('author')" class="mt-2" />
                    </div>

                    <div>
                        <label for="category" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kategori</label>
                        <div class="relative mt-2">
                            <select id="category" name="category" required
                                class="w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 pr-10 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20 appearance-none">
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="Teknologi" {{ old('category') === 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                <option value="Manga" {{ old('category') === 'Manga' ? 'selected' : '' }}>Manga</option>
                                <option value="Manhwa" {{ old('category') === 'Manhwa' ? 'selected' : '' }}>Manhwa</option>
                                <option value="Sejarah" {{ old('category') === 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#4c5b54]">
                                <span class="material-symbols-rounded">expand_more</span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <label for="quantity" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah Stok</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="0" required
                        class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20" />
                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                </div>

                <div>
                    <label for="description" class="text-sm font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Deskripsi Buku</label>
                    <textarea id="description" name="description" rows="5" required
                        class="mt-2 w-full rounded-[1.75rem] border border-[#dcd2bd] bg-white px-4 py-3 text-sm text-[#172a37] placeholder:text-[#9aa29a] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20"
                        placeholder="Ceritakan ringkasan menarik mengenai isi buku...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('admin.books.index') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-4 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                        <span class="material-symbols-rounded text-base">arrow_back</span>
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-5 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                        <span class="material-symbols-rounded text-base">save</span>
                        Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const coverInput = document.getElementById('cover');
        const preview = document.getElementById('preview');
        const changeCoverBtn = document.getElementById('changeCoverBtn');

        // buka file dialog saat tombol diklik
        changeCoverBtn.addEventListener('click', () => coverInput.click());

        // preview gambar yang dipilih
        coverInput.addEventListener('change', (e) => {
            const [file] = e.target.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    preview.src = event.target.result;
                    preview.classList.remove('opacity-70');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='128' height='192' viewBox='0 0 128 192'%3E%3Crect width='128' height='192' fill='%23f6ecda'/%3E%3C/svg%3E";
                preview.classList.add('opacity-70');
            }
        });
    </script>
</x-app-layout>
