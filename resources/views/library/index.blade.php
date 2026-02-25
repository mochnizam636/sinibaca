@extends('layouts.user')

@section('title', 'Library Saya')
@section('description', 'Kelola koleksi novel, histori bacaan, dan reading list Anda dalam satu tempat.')

@section('content')
<div class="relative min-h-[calc(100vh-4rem)]">
    <!-- Meteor Effect Container -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div id="meteors-container" class="absolute inset-0 w-full h-full"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/50 to-zinc-950"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-black text-white tracking-tight flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-zinc-800 border border-zinc-700 flex items-center justify-center shadow-lg">
                        <i data-lucide="library" class="w-5 h-5 text-indigo-500"></i>
                    </div>
                    Library Saya
                </h1>
                <p class="text-zinc-400 mt-2 text-sm">Kelola semua aktivitas membaca Anda di sini.</p>
            </div>
            
            <div class="flex p-1 bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-lg">
                <a href="{{ route('library.index', ['tab' => 'history']) }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $tab === 'history' ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                    <span class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        History <span class="bg-zinc-950 px-1.5 py-0.5 rounded text-[10px] text-zinc-500 {{ $tab === 'history' ? 'text-zinc-300' : '' }}">{{ $history->count() }}</span>
                    </span>
                </a>
                <a href="{{ route('library.index', ['tab' => 'bookmark']) }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $tab === 'bookmark' ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                    <span class="flex items-center gap-2">
                        <i data-lucide="bookmark" class="w-4 h-4"></i>
                        Bookmarks <span class="bg-zinc-950 px-1.5 py-0.5 rounded text-[10px] text-zinc-500 {{ $tab === 'bookmark' ? 'text-zinc-300' : '' }}">{{ $bookmarks->count() }}</span>
                    </span>
                </a>
                <a href="{{ route('library.index', ['tab' => 'readlist']) }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium transition-all {{ $tab === 'readlist' ? 'bg-zinc-800 text-white shadow-sm' : 'text-zinc-400 hover:text-white hover:bg-zinc-800/50' }}">
                     <span class="flex items-center gap-2">
                        <i data-lucide="list" class="w-4 h-4"></i>
                        Readlist <span class="bg-zinc-950 px-1.5 py-0.5 rounded text-[10px] text-zinc-500 {{ $tab === 'readlist' ? 'text-zinc-300' : '' }}">{{ $readlist->count() }}</span>
                    </span>
                </a>
            </div>
        </div>

        <!-- Content Area -->
        <div class="min-h-[400px]">
            @if($tab === 'history')
                @if($history->count() > 0)
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        @foreach($history as $item)
                             @if($item->novel)
                                <div class="group flex gap-4 bg-zinc-900/40 border border-zinc-800 rounded-xl p-4 hover:bg-zinc-900 hover:border-zinc-700 transition-all hover:shadow-lg">
                                    <!-- Cover -->
                                    <a href="{{ route('novel.show', $item->novel) }}" class="shrink-0 w-24 aspect-[2/3] rounded-lg overflow-hidden border border-zinc-800 relative bg-zinc-800">
                                        @if($item->novel->cover_image)
                                            <img src="{{ Storage::url($item->novel->cover_image) }}" alt="{{ $item->novel->title }}" 
                                                 class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-zinc-800 text-zinc-600">
                                                <i data-lucide="book" class="w-8 h-8"></i>
                                            </div>
                                        @endif
                                    </a>

                                    <div class="flex flex-col flex-1 min-w-0">
                                        <div class="flex justify-between items-start gap-2">
                                            <div>
                                                <h3 class="font-bold text-zinc-200 line-clamp-1 group-hover:text-indigo-400 transition-colors">
                                                    <a href="{{ route('novel.show', $item->novel) }}">{{ $item->novel->title }}</a>
                                                </h3>
                                                <p class="text-xs text-zinc-500 mt-0.5">{{ $item->novel->author->name ?? 'Unknown Author' }}</p>
                                            </div>
                                            <form action="{{ route('library.history.remove', $item->novel) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-zinc-600 hover:text-red-400 transition-colors p-1" title="Hapus dari history">
                                                    <i data-lucide="x" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <div class="mt-auto pt-4 space-y-3">
                                            @if($item->chapter)
                                                <div class="flex items-center justify-between text-xs">
                                                    <span class="text-zinc-400">Terakhir dibaca: <span class="text-zinc-300 font-medium line-clamp-1 max-w-[150px] inline-block align-bottom">{{ $item->chapter->title }}</span></span>
                                                    <span class="text-zinc-600">{{ $item->updated_at->diffForHumans() }}</span>
                                                </div>
                                                
                                                <a href="{{ route('reader.show', [$item->novel, $item->chapter]) }}" 
                                                   class="flex items-center justify-center gap-2 w-full py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg transition-all shadow-sm shadow-indigo-500/10 group-hover:shadow-indigo-500/30">
                                                    <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
                                                    Lanjutkan Membaca
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-center border-2 border-dashed border-zinc-800 rounded-2xl bg-zinc-900/20">
                        <div class="w-20 h-20 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center mb-6 shadow-inner">
                            <i data-lucide="clock" class="w-10 h-10 text-zinc-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Belum Ada History</h3>
                        <p class="text-zinc-500 max-w-sm mx-auto mb-8">Mulai baca novel untuk melihat riwayat bacaan Anda di sini.</p>
                        <a href="{{ route('explore') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-bold transition-all shadow-lg shadow-indigo-600/20">
                            <i data-lucide="compass" class="w-4 h-4"></i>
                            Jelajahi Novel
                        </a>
                    </div>
                @endif
            
            @elseif($tab === 'bookmark')
                 @if($bookmarks->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                        @foreach($bookmarks as $item)
                            @if($item->novel)
                                <div class="group relative">
                                    <div class="relative aspect-[2/3] rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 shadow-md transition-all group-hover:-translate-y-1 group-hover:shadow-xl group-hover:border-zinc-600">
                                        <a href="{{ route('novel.show', $item->novel) }}" class="block w-full h-full">
                                            @if($item->novel->cover_image)
                                                <img src="{{ Storage::url($item->novel->cover_image) }}" alt="{{ $item->novel->title }}" 
                                                     class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-zinc-800 text-zinc-600">
                                                    <i data-lucide="book" class="w-8 h-8"></i>
                                                </div>
                                            @endif
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                                        </a>

                                        <!-- Badge -->
                                        <div class="absolute top-2 left-2">
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-zinc-950/80 backdrop-blur-sm text-zinc-300 border border-white/10">
                                                {{ $item->novel->genre->name ?? 'Novel' }}
                                            </span>
                                        </div>

                                        <!-- Remove Button -->
                                        <form action="{{ route('library.bookmark.remove', $item->novel) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-md bg-black/60 backdrop-blur-sm text-zinc-400 hover:text-red-400 hover:bg-black transition-colors" title="Hapus Bookmark">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>

                                        <!-- Info -->
                                        <div class="absolute bottom-0 inset-x-0 p-3">
                                            <h3 class="text-sm font-bold text-white line-clamp-1 group-hover:text-indigo-400 transition-colors">{{ $item->novel->title }}</h3>
                                            <p class="text-[10px] text-zinc-400 line-clamp-1">{{ $item->novel->author->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                 @else
                    <div class="flex flex-col items-center justify-center py-20 text-center border-2 border-dashed border-zinc-800 rounded-2xl bg-zinc-900/20">
                        <div class="w-20 h-20 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center mb-6 shadow-inner">
                            <i data-lucide="bookmark" class="w-10 h-10 text-zinc-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Bookmark Kosong</h3>
                        <p class="text-zinc-500 max-w-sm mx-auto mb-8">Simpan novel favorit Anda agar mudah ditemukan kembali.</p>
                        <a href="{{ route('explore') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-bold transition-all shadow-lg shadow-indigo-600/20">
                            <i data-lucide="compass" class="w-4 h-4"></i>
                            Jelajahi Novel
                        </a>
                    </div>
                 @endif

            @else
                <!-- Readlist -->
                 @if($readlist->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
                        @foreach($readlist as $item)
                            @if($item->novel)
                                <div class="group relative">
                                    <div class="relative aspect-[2/3] rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 shadow-md transition-all group-hover:-translate-y-1 group-hover:shadow-xl group-hover:border-pink-500/30">
                                        <a href="{{ route('novel.show', $item->novel) }}" class="block w-full h-full">
                                            @if($item->novel->cover_image)
                                                <img src="{{ Storage::url($item->novel->cover_image) }}" alt="{{ $item->novel->title }}" 
                                                     class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-zinc-800 text-zinc-600">
                                                    <i data-lucide="book" class="w-8 h-8"></i>
                                                </div>
                                            @endif
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 group-hover:opacity-40 transition-opacity"></div>
                                        </a>

                                         <!-- Badge -->
                                        <div class="absolute top-2 left-2">
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-pink-500/20 backdrop-blur-sm text-pink-300 border border-pink-500/30">
                                                Readlist
                                            </span>
                                        </div>

                                        <!-- Remove Button -->
                                        <form action="{{ route('library.readlist.remove', $item->novel) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-md bg-black/60 backdrop-blur-sm text-zinc-400 hover:text-red-400 hover:bg-black transition-colors" title="Hapus dari Readlist">
                                                <i data-lucide="list-x" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </form>

                                        <!-- Info -->
                                        <div class="absolute bottom-0 inset-x-0 p-3">
                                            <h3 class="text-sm font-bold text-white line-clamp-1 group-hover:text-pink-400 transition-colors">{{ $item->novel->title }}</h3>
                                            <p class="text-[10px] text-zinc-400 line-clamp-1">{{ $item->novel->author->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-center border-2 border-dashed border-zinc-800 rounded-2xl bg-zinc-900/20">
                        <div class="w-20 h-20 rounded-2xl bg-zinc-900 border border-zinc-800 flex items-center justify-center mb-6 shadow-inner">
                            <i data-lucide="list-plus" class="w-10 h-10 text-zinc-600"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Readlist Kosong</h3>
                        <p class="text-zinc-500 max-w-sm mx-auto mb-8">Buat daftar bacaan Anda sendiri untuk nanti.</p>
                        <a href="{{ route('explore') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-bold transition-all shadow-lg shadow-indigo-600/20">
                            <i data-lucide="compass" class="w-4 h-4"></i>
                            Jelajahi Novel
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>



<style>
    /* Meteor Animation Ref */
    .meteor {
        position: absolute;
        width: 300px;
        height: 1px;
        background: linear-gradient(to right, rgba(99, 102, 241, 0) 0%, rgba(99, 102, 241, 0.8) 50%, rgba(99, 102, 241, 0) 100%);
        transform: rotate(-45deg);
        pointer-events: none;
        opacity: 0;
        filter: drop-shadow(0 0 4px rgba(99, 102, 241, 0.5));
    }
    .meteor::before {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 3px;
        background: #818cf8;
        border-radius: 50%;
        box-shadow: 0 0 10px 1px #818cf8;
    }
    @keyframes meteor-fall {
        0% { opacity: 1; transform: rotate(-45deg) translateX(0); }
        70% { opacity: 1; }
        100% { opacity: 0; transform: rotate(-45deg) translateX(-1000px); }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) window.lucide.createIcons();

        // Meteors
        const container = document.getElementById('meteors-container');
        if (container) {
            const meteorCount = 10;
            function createMeteor() {
                const meteor = document.createElement('div');
                meteor.classList.add('meteor');
                const top = Math.random() * 100;
                const left = Math.random() * 100;
                const duration = Math.random() * 3 + 2;
                const delay = Math.random() * 5;
                meteor.style.top = top + '%';
                meteor.style.left = left + '%';
                meteor.style.animation = `meteor-fall ${duration}s linear infinite`;
                meteor.style.animationDelay = delay + 's';
                container.appendChild(meteor);
            }
            for (let i = 0; i < meteorCount; i++) createMeteor();
        }
    });
</script>
@endsection

@once
    <!-- Define Empty State Component Blade Logic manually since we are in a single file edit -->
    @php
        $__env->startComponent('bs::components.empty-state', ['icon' => 'book', 'title' => 'Empty', 'message' => 'Empty']);
    @endphp
@endonce