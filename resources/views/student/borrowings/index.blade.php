<x-app-layout>
    <x-slot name="pageHeading">
        Riwayat Peminjaman Saya
    </x-slot>

    <x-slot name="pageDescription">
        Lacak status peminjaman dan jadwal pengembalian bukumu di sini.
    </x-slot>

    <div class="overflow-hidden rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#eaddc2] text-sm">
                <thead class="bg-[#fff7ec]">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Judul Buku</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Jumlah</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Tanggal Pinjam</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Tanggal Kembali</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-[0.3em] text-[#6b766f]">Catatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#f1e6cf]">
                    @forelse ($borrowings as $borrowing)
                        <tr class="hover:bg-[#fdf4e3]/60">
                            <td class="px-4 py-4 text-xs font-semibold uppercase tracking-[0.3em] text-[#9aa29a]">{{ $loop->iteration + ($borrowings->currentPage() - 1) * $borrowings->perPage() }}</td>
                            <td class="px-4 py-4">
                                <p class="font-semibold text-[#172a37]">{{ $borrowing->book->title }}</p>
                                <p class="text-xs text-[#4c5b54]">{{ $borrowing->book->author ?? 'Penulis tidak diketahui' }}</p>
                            </td>
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
                            <td class="px-4 py-4 text-xs text-[#4c5b54]">
                                {{ $borrowing->notes ? $borrowing->notes : 'Tidak ada catatan tambahan.' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-sm text-[#4c5b54]">Kamu belum pernah meminjam buku. Mulai jelajahi katalog sekarang!</td>
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
