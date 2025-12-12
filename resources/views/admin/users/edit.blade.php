<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-black-900 dark:text-black-100 leading-tight tracking-tight">
            Edit User: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Card premium yang konsisten --}}
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-lg sm:rounded-lg">
                <div class="p-4 sm:p-8">
                    {{-- Form mengarah ke route 'update' --}}
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- Gunakan method PUT untuk update --}}

                        {{-- Nama --}}
                        <div>
                            <x-input-label for="name" value="Nama Lengkap" />
                            {{-- Tampilkan data 'name' yang ada --}}
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" value="Email" />
                            {{-- Tampilkan data 'email' yang ada --}}
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password (Opsional) --}}
                        <div>
                            <x-input-label for="password" value="Password Baru (Opsional)" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password" />
                            <p class="mt-1 text-sm text-black-600 dark:text-black-400">
                                Kosongkan jika Anda tidak ingin mengubah password.
                            </p>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password Baru" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        {{-- Roles (Checkbox) --}}
                        <div>
                            <x-input-label value="Roles" />
                            <div class="mt-2 space-y-2">
                                @foreach ($roles as $role)
                                    <label for="role_{{ $role->id }}" class="flex items-center">
                                        <input id="role_{{ $role->id }}" name="roles[]" type="checkbox"
                                            value="{{ $role->name }}" {{-- Cek role yang sudah dimiliki user --}}
                                            @checked(old('roles', $user->roles->pluck('name'))->contains($role->name))
                                            class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                        <span
                                            class="ms-2 text-sm text-black-600 dark:text-black-400">{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Perbarui') }}</x-primary-button>
                            <a href="{{ route('admin.users.index') }}">
                                <x-secondary-button type="button">{{ __('Batal') }}</x-secondary-button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
