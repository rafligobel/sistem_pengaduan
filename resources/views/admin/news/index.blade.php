<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Manajemen Berita') }}
            </h2>
            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tulis Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($news as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden group">
                        <div class="aspect-w-16 aspect-h-9 bg-slate-100 relative overflow-hidden h-48">
                            <img src="{{ asset('storage/' . $item->image_path) }}" 
                                 alt="{{ $item->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-slate-900 mb-1 line-clamp-1" title="{{ $item->title }}">{{ $item->title }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                            
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">{{ $item->created_at->format('d M Y') }}</span>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus berita ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 hover:bg-red-100 rounded text-xs font-bold transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-lg border border-dashed border-slate-300">
                        <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" data-src="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        <h3 class="mt-2 text-sm font-medium text-slate-900">Belum ada berita</h3>
                        <p class="mt-1 text-sm text-slate-500">Mulai dengan mempublikasikan berita terbaru.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                Buat Berita
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
