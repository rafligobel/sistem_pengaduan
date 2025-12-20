<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Edit Kategori') }}: <span class="text-blue-600">{{ $category->name }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            {{-- Card Style Konsisten --}}
            <div class="bg-white border border-slate-300 shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nama Kategori')" class="text-slate-700" />
                            <x-text-input id="name" name="name" type="text"
                                class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                :value="old('name', $category->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.categories.index') }}">
                                <x-secondary-button type="button" class="border-slate-300 text-slate-700 hover:bg-slate-50">
                                    {{ __('Batal') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800">
                                {{ __('Perbarui Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>