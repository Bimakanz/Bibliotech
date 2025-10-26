<x-app-layout>
    <x-slot name="pageHeading">
        Dashboard Pribadi
    </x-slot>

    <x-slot name="pageDescription">
        Ringkasan aktivitas akun dan akses cepat menuju fitur utama Bibliotech.
    </x-slot>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-[2rem] border border-[#dcd2bd] bg-white/85 p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-[#172a37]" style="font-family: 'Space Grotesk', sans-serif;">Status Masuk</h3>
            <p class="mt-3 text-sm text-[#4c5b54]">
                {{ __("Selamat datang kembali! Kamu berhasil masuk ke Bibliotech.") }}
            </p>
        </div>
        <div class="rounded-[2rem] border border-[#0f766e]/40 bg-[#0f766e]/10 p-6 text-[#115e59] shadow-sm">
            <h3 class="text-lg font-semibold" style="font-family: 'Space Grotesk', sans-serif;">Langkah Berikutnya</h3>
            <p class="mt-3 text-sm">
                Jelajahi katalog, pantau peminjaman, atau perbarui profil sesuai kebutuhanmu.
            </p>
        </div>
        <div class="rounded-[2rem] border border-[#f4bb7a] bg-[#fff1dc] p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-[#2d3c32]" style="font-family: 'Space Grotesk', sans-serif;">Butuh Bantuan?</h3>
            <p class="mt-3 text-sm text-[#5c4a2d]">
                Hubungi admin perpustakaan untuk mendapatkan panduan penggunaan fitur baru.
            </p>
        </div>
    </div>
</x-app-layout>
