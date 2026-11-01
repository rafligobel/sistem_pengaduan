<section class="space-y-6">
    <header>
        <h2 class="text-lg font-bold text-slate-900">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-slate-600">
            {{ __('Setelah akun Anda dihapus, semua data dan histori pengaduan yang terkait dengan akun ini akan dihapus secara permanen. Sebelum menghapus akun, pastikan Anda telah mencatat kode tiket atau mengunduh data penting yang Anda butuhkan.') }}
        </p>
    </header>

    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Hapus Akun') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-slate-900">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-2 text-sm text-slate-600">
                {{ __('Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi akun Anda untuk mengonfirmasi penghapusan permanen akun ini.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password_delete" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input id="password_delete" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="{{ __('Masukkan Kata Sandi') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Konfirmasi Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
