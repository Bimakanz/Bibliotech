<x-app-layout>
    <x-slot name="pageHeading">
        Pengaturan Profil
    </x-slot>

    <x-slot name="pageDescription">
        Perbarui informasi akun, kata sandi, dan kelola akses Bibliotech-mu.
    </x-slot>

    <div class="space-y-6">
        <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="rounded-[2.5rem] border border-[#dcd2bd] bg-white/90 p-6 shadow-[0_25px_70px_-45px_rgba(15,87,82,0.45)]">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="rounded-[2.5rem] border border-[#be123c]/30 bg-[#be123c]/10 p-6 shadow-[0_25px_70px_-45px_rgba(190,18,60,0.35)]">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
