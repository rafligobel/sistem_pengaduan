<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold">Langkah 1: Biodata Pelapor</h2>
        <p class="text-sm text-gray-600">Silakan isi data diri Anda dengan benar.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('complaint.public.step1.post') }}">
        @csrf

        <div>
            <x-input-label for="nama_pelapor" value="Nama Lengkap" />
            <x-text-input id="nama_pelapor" class="block mt-1 w-full" type="text" name="nama_pelapor" :value="old('nama_pelapor', $biodata['nama_pelapor'] ?? '')"
                required autofocus />
            <x-input-error :messages="$errors->get('nama_pelapor')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email_pelapor" value="Email" />
            <x-text-input id="email_pelapor" class="block mt-1 w-full" type="email" name="email_pelapor"
                :value="old('email_pelapor', $biodata['email_pelapor'] ?? '')" required />
            <x-input-error :messages="$errors->get('email_pelapor')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telepon_pelapor" value="Nomor Telepon (WA)" />
            <x-text-input id="telepon_pelapor" class="block mt-1 w-full" type="text" name="telepon_pelapor"
                :value="old('telepon_pelapor', $biodata['telepon_pelapor'] ?? '')" required />
            <x-input-error :messages="$errors->get('telepon_pelapor')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Lanjut ke Langkah 2
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
