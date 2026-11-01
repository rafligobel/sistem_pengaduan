<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 leading-tight tracking-tight">
            Tambah User Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div class="bg-white border border-slate-300 shadow-lg sm:rounded-lg">
                {{-- Menggunakan padding yang sama dengan profile/edit --}}
                <div class="p-4 sm:p-8">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name')" required autofocus placeholder="Nama Lengkap" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- NIK --}}
                        <div>
                            <x-input-label for="nik" value="Nomor Induk Kependudukan (NIK)" />
                            <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full"
                                :value="old('nik')" maxlength="16" inputmode="numeric" placeholder="16 digit NIK (opsional jika bukan pelapor/pengguna)" />
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>

                        {{-- Nomor Telepon --}}
                        <div>
                            <x-input-label for="phone" value="Nomor Telepon / WhatsApp" />
                            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"
                                :value="old('phone')" placeholder="Contoh: 081234567890" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email')" required placeholder="nama@email.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" value="Password" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                required autocomplete="new-password" placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" required autocomplete="new-password" placeholder="••••••••" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Roles (Checkbox) --}}
                        <div>
                            <x-input-label value="Roles" />
                            <div class="mt-2 space-y-2">
                                @foreach ($roles as $role)
                                    <label for="role_{{ $role->id }}" class="flex items-center">
                                        <input id="role_{{ $role->id }}" name="roles[]" type="checkbox"
                                             value="{{ $role->name }}"
                                             class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ms-2 text-sm text-slate-600 font-medium">{{ ucfirst($role->name) }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center gap-4 pt-4 border-t border-slate-200">
                            <x-primary-button>{{ __('Simpan Pengguna') }}</x-primary-button>

                            <x-secondary-button href="{{ route('admin.users.index') }}">
                                {{ __('Batal') }}
                            </x-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
