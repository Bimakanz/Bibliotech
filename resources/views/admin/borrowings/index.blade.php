<x-app-layout>
    <x-slot name="pageHeading">
        Data Peminjaman Buku
    </x-slot>

    <x-slot name="pageDescription">
        Pantau seluruh proses peminjaman, ubah status, dan kembalikan stok buku secara real-time.
    </x-slot>

    <div class="overflow-hidden rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#eaddc2] text-sm">
                <thead class="bg-[#fff7ec]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Peminjam</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Judul Buku</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Tanggal Pinjam</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Tanggal Kembali</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6cf]">
                    @forelse ($borrowings as $borrowing)
                        <tr class="hover:bg-[#fdf4e3]/60">
                            <td class="px-4 py-4 text-xs font-semibold uppercase tracking-[0.3em] text-[#9aa29a]">{{ $loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage() }}</td>
                            <td class="px-4 py-4">
                                <p class="font-medium text-[#172a37]">{{ $borrowing->borrower_name }}</p>
                                <p class="text-xs text-[#4c5b54]">{{ $borrowing->user->username }}</p>
                            </td>
                            <td class="px-4 py-4 text-sm text-[#4c5b54]">{{ $borrowing->book->title }}</td>
                            <td class="px-4 py-4 text-center text-sm font-semibold text-[#172a37]">{{ $borrowing->quantity }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold capitalize
                                    @if($borrowing->status === 'processing') border-[#f97316]/40 bg-[#f97316]/10 text-[#b45309]
                                    @elseif($borrowing->status === 'borrowed') border-[#0f766e]/40 bg-[#0f766e]/10 text-[#0f4c3a]
                                    @else border-[#166534]/40 bg-[#dcfce7] text-[#166534] @endif">
                                    <span class="material-symbols-rounded text-sm">progress_activity</span>
                                    {{ $borrowing->statusLabel() }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-xs text-[#4c5b54]">{{ $borrowing->borrowed_at->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-4 text-xs text-[#4c5b54]">{{ $borrowing->return_date->translatedFormat('d M Y') }}</td>
                            <td class="px-4 py-4">
                                <form method="POST" action="{{ route('admin.borrowings.update', $borrowing) }}" class="flex flex-col gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="rounded-[1.5rem] border border-[#dcd2bd] bg-white px-3 py-2 text-xs font-medium uppercase tracking-[0.3em] text-[#4c5b54] focus:border-[#0f766e] focus:outline-none focus:ring-2 focus:ring-[#0f766e]/20">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}" @selected(old('status', $borrowing->status) === $status)>{{ \App\Models\Borrowing::statusLabels()[$status] ?? ucfirst($status) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#0f766e] px-3 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-[#115e59]">
                                        <span class="material-symbols-rounded text-base">sync</span>
                                        Ubah Status
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-sm text-[#4c5b54]">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        {{ $borrowings->links() }}
    </div>
</x-app-layout>
