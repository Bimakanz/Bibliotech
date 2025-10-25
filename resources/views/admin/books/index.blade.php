<x-app-layout>
    <x-slot name="pageHeading">
        Kelola Koleksi Buku
    </x-slot>

    <x-slot name="pageDescription">
        Tambah, perbarui, atau hapus informasi buku yang tersedia di perpustakaan.
    </x-slot>

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-lg font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">Daftar Buku</h2>
            <p class="text-sm text-[#4c5b54]">Total {{ $books->total() }} buku terdaftar.</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="inline-flex items-center gap-2 rounded-full bg-[#0f766e] px-4 py-2 text-sm font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
            <span class="material-symbols-rounded text-base">add</span>
            Tambah Buku Baru
        </a>
    </div>

    <style>
        .delete-transition {
            transition: all 0.3s ease-in-out;
        }
        
        #toast {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
    </style>
    
    <div class="overflow-hidden rounded-[2.5rem] border border-[#dcd2bd] bg-white/85 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
        <!-- Desktop Table (hidden on mobile) -->
        <div class="hidden md:block">
            <table class="min-w-full divide-y divide-[#eaddc2] text-sm">
                <thead class="bg-[#fff7ec]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Buku</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Kategori</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Gambar</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Stok</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Deskripsi</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6cf]">
                    @forelse ($books as $book)
                        <tr class="hover:bg-[#fdf4e3]/60">
                            <td class="px-4 py-4 text-xs font-semibold uppercase tracking-[0.3em] text-[#9aa29a]">{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">{{ $book->title }}</p>
                                <p class="text-xs text-[#4c5b54]">{{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                            </td>
                            <td class="px-4 py-4 text-xs font-medium uppercase tracking-[0.3em] text-[#b95d23]">{{ $book->category }}</td>
                            <td class="px-4 py-4">
                                <div class="h-16 w-16 overflow-hidden rounded-[1.25rem] border border-[#eaddc2] bg-[#f6ecda]">
                                    @if ($book->cover_image_path)
                                        <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-[10px] font-semibold uppercase tracking-[0.3em] text-[#b69c74]">Tanpa</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center text-sm font-semibold {{ $book->quantity > 0 ? 'text-[#0f766e]' : 'text-[#be123c]' }}">{{ $book->quantity }}</td>
                            <td class="px-4 py-4 text-xs text-[#4c5b54]">
                                <p class="max-w-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($book->description, 120) }}</p>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex flex-col gap-2">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-[#0f766e]/40 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/10">
                                        <span class="material-symbols-rounded text-base">edit</span>
                                        Edit
                                    </a>
                                    <a href="{{ route('admin.books.show', $book) }}" class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                                        <span class="material-symbols-rounded text-base">visibility</span>
                                        Detail
                                    </a>
                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="delete-form" data-book-title="{{ $book->title }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-[#be123c] px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#991b1b] delete-btn">
                                            <span class="material-symbols-rounded text-base">delete</span>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-sm text-[#4c5b54]">Belum ada data buku. Tambahkan buku pertama Anda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (hidden on desktop) -->
        <div class="md:hidden divide-y divide-[#f1e6cf]">
            @forelse ($books as $book)
                <div class="p-4 hover:bg-[#fdf4e3]/60 transition">
                    <div class="flex items-start gap-4">
                        <!-- Gambar -->
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 overflow-hidden rounded-[1.25rem] border border-[#eaddc2] bg-[#f6ecda]">
                                @if ($book->cover_image_path)
                                    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Sampul {{ $book->title }}" class="h-full w-full object-cover" />
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-[8px] font-semibold uppercase tracking-[0.2em] text-[#b69c74]">Tanpa</div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Informasi Buku -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="font-semibold text-[#172a37] text-sm" style="font-family: 'Space Grotesk', sans-serif;">{{ $book->title }}</p>
                                <span class="text-xs font-semibold {{ $book->quantity > 0 ? 'text-[#0f766e]' : 'text-[#be123c]' }}">{{ $book->quantity }}</span>
                            </div>
                            <p class="text-xs text-[#4c5b54] mt-1">{{ $book->author ?? 'Penulis tidak diketahui' }}</p>
                            <p class="text-xs font-medium uppercase tracking-[0.3em] text-[#b95d23] mt-1">{{ $book->category }}</p>
                            <p class="text-xs text-[#4c5b54] mt-2 line-clamp-2">{{ \Illuminate\Support\Str::limit($book->description, 80) }}</p>
                            
                            <!-- Aksi untuk mobile -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center gap-1 rounded-full border border-[#0f766e]/40 px-2 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#0f766e] transition hover:border-[#0f766e]/60 hover:bg-[#0f766e]/10">
                                    <span class="material-symbols-rounded text-xs">edit</span>
                                    Edit
                                </a>
                                <a href="{{ route('admin.books.show', $book) }}" class="inline-flex items-center gap-1 rounded-full border border-[#dcd2bd] px-2 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                                    <span class="material-symbols-rounded text-xs">visibility</span>
                                    Detail
                                </a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="delete-form-mobile" data-book-title="{{ $book->title }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-full bg-[#be123c] px-2 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#991b1b] delete-btn-mobile">
                                        <span class="material-symbols-rounded text-xs">delete</span>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-sm text-[#4c5b54]">
                    Belum ada data buku. Tambahkan buku pertama Anda.
                </div>
            @endforelse
        </div>
    </div>

    <div class="flex justify-center mt-6">
        <nav class="flex items-center gap-2">
            <!-- Previous button -->
            @if ($books->onFirstPage())
                <span class="inline-flex items-center justify-center rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500 cursor-not-allowed">
                    <span class="material-symbols-rounded text-base">chevron_left</span>
                </span>
            @else
                <a href="{{ $books->previousPageUrl() }}" class="inline-flex items-center justify-center rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#115e59]">
                    <span class="material-symbols-rounded text-base">chevron_left</span>
                </a>
            @endif

            <!-- Page numbers -->
            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                @if ($page == $books->currentPage())
                    <span class="inline-flex items-center justify-center rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}" class="inline-flex items-center justify-center rounded-full bg-[#dcd2bd] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            <!-- Next button -->
            @if ($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}" class="inline-flex items-center justify-center rounded-full bg-[#0f766e] px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-[#115e59]">
                    <span class="material-symbols-rounded text-base">chevron_right</span>
                </a>
            @else
                <span class="inline-flex items-center justify-center rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-gray-500 cursor-not-allowed">
                    <span class="material-symbols-rounded text-base">chevron_right</span>
                </span>
            @endif
        </nav>
    </div>
    
    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center">
        <div class="absolute inset-0 bg-black/50" id="modalBackdrop"></div>
        <div class="relative bg-white rounded-2xl p-6 w-11/12 max-w-md mx-auto shadow-xl z-10 transform scale-95 opacity-0 transition-transform transition-opacity duration-200">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <span class="material-symbols-rounded text-red-600 text-2xl">warning</span>
                </div>
                <h3 class="text-lg font-semibold text-[#172a37] mt-4" style="font-family: 'Space Grotesk', sans-serif;">Konfirmasi Penghapusan</h3>
                <p class="text-sm text-[#4c5b54] mt-2">Apakah Anda yakin ingin menghapus buku <span id="bookTitle" class="font-semibold"></span>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            
            <div class="mt-6 flex justify-center gap-3">
                <button id="cancelDelete" class="inline-flex items-center gap-2 rounded-full border border-[#dcd2bd] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-[#4c5b54] transition hover:bg-[#fdf4e3]">
                    Batal
                </button>
                <button id="confirmDelete" class="inline-flex items-center gap-2 rounded-full bg-[#be123c] px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#991b1b]">
                    Hapus
                </button>
            </div>
        </div>
    </div>
    
    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 z-50 hidden">
        <div class="bg-white border border-[#dcd2bd] rounded-full px-4 py-3 shadow-[0_5px_15px_rgba(0,0,0,0.1)] flex items-center gap-3">
            <span class="material-symbols-rounded text-green-600">check_circle</span>
            <span id="toastMessage" class="text-sm font-medium text-[#172a37]">Buku berhasil dihapus!</span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteModal');
            const modalBackdrop = document.getElementById('modalBackdrop');
            const cancelDelete = document.getElementById('cancelDelete');
            const confirmDelete = document.getElementById('confirmDelete');
            const bookTitle = document.getElementById('bookTitle');
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            
            let currentForm = null;
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentForm = this.closest('.delete-form');
                    const title = currentForm.getAttribute('data-book-title');
                    bookTitle.textContent = title;
                    showDeleteModal();
                });
            });
            
            // Handle mobile delete buttons
            const deleteButtonsMobile = document.querySelectorAll('.delete-btn-mobile');
            
            deleteButtonsMobile.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentForm = this.closest('.delete-form-mobile');
                    const title = currentForm.getAttribute('data-book-title');
                    bookTitle.textContent = title;
                    showDeleteModal();
                });
            });
            
            function showDeleteModal() {
                deleteModal.classList.remove('hidden');
                // Trigger the animation
                setTimeout(() => {
                    const modalContent = deleteModal.querySelector('.transform');
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            }
            
            function hideDeleteModal() {
                const modalContent = deleteModal.querySelector('.transform');
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    deleteModal.classList.add('hidden');
                }, 200);
            }
            
            modalBackdrop.addEventListener('click', hideDeleteModal);
            cancelDelete.addEventListener('click', hideDeleteModal);
            
            confirmDelete.addEventListener('click', function() {
                if (currentForm) {
                    // Add animation to the row being deleted
                    const row = currentForm.closest('tr');
                    row.classList.add('delete-transition');
                    
                    // Fade out animation
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-100%)';
                    
                    setTimeout(() => {
                        currentForm.submit();
                    }, 300);
                }
            });
            
            // Show toast notification if deletion was successful
            @if(session('status'))
                showToast('{{ session('status') }}');
            @endif
            
            function showToast(message) {
                toastMessage.textContent = message;
                toast.classList.remove('hidden');
                toast.classList.add('delete-transition');
                
                // Animate in
                toast.style.transform = 'translateX(100%)';
                toast.style.opacity = '0';
                
                setTimeout(() => {
                    toast.style.transform = 'translateX(0)';
                    toast.style.opacity = '1';
                }, 10);
                
                // Auto hide after 3 seconds
                setTimeout(() => {
                    toast.style.transform = 'translateX(100%)';
                    toast.style.opacity = '0';
                    
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 300);
                }, 3000);
            }
        });
    </script>
</x-app-layout>
