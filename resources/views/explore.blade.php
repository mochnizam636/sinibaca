@extends('layouts.user')

@section('title', 'Explore Novel')
@section('description', 'Jelajahi koleksi novel lengkap dengan filter genre dan kategori.')

@section('content')
    <div class="relative min-h-[calc(100vh-4rem)]">
        <!-- Meteor Effect Container -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div id="meteors-container" class="absolute inset-0 w-full h-full"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/50 to-zinc-950"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <!-- Header -->
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight mb-3">Explore Novel</h1>
                <p class="text-zinc-400 text-lg">Temukan cerita favoritmu dari ribuan koleksi kami.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters Sidebar -->
                <aside class="lg:w-72 flex-shrink-0">
                    <form action="{{ route('explore') }}" method="GET"
                        class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-xl p-6 sticky top-24 shadow-xl">
                        <div class="flex items-center gap-2 mb-6 text-white font-bold pb-4 border-b border-zinc-800">
                            <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
                            <h3>Filter Pencarian</h3>
                        </div>

                        <!-- Search -->
                        <div class="mb-6 space-y-2">
                            <label class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Kata Kunci</label>
                            <div class="relative">
                                <i data-lucide="search"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Judul, penulis..."
                                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg pl-9 pr-4 py-2.5 text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                            </div>
                        </div>

                        <!-- Genre -->
                        <div class="mb-6 space-y-2">
                            <label class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Genre</label>
                            <div class="relative">
                                <i data-lucide="tag"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500"></i>
                                <select name="genre"
                                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg pl-9 pr-4 py-2.5 text-sm text-white appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                    <option value="">Semua Genre</option>
                                    @foreach($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                            {{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i data-lucide="chevron-down"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="mb-6 space-y-2">
                            <label class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Kategori</label>
                            <div class="relative">
                                <i data-lucide="layers"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500"></i>
                                <select name="category"
                                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg pl-9 pr-4 py-2.5 text-sm text-white appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <i data-lucide="chevron-down"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500 pointer-events-none"></i>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="mb-8 space-y-2">
                            <label class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Urutkan</label>
                            <div class="relative">
                                <i data-lucide="arrow-up-down"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500"></i>
                                <select name="sort"
                                    class="w-full bg-zinc-950 border border-zinc-800 rounded-lg pl-9 pr-4 py-2.5 text-sm text-white appearance-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all cursor-pointer">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru Update
                                    </option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler
                                    </option>
                                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul (A-Z)
                                    </option>
                                </select>
                                <i data-lucide="chevron-down"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500 pointer-events-none"></i>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-lg transition-all shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 flex items-center justify-center gap-2">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                            Terapkan Filter
                        </button>

                        @if(request()->hasAny(['search', 'genre', 'category', 'sort']))
                            <a href="{{ route('explore') }}"
                                class="mt-4 flex items-center justify-center gap-2 w-full py-2.5 rounded-lg border border-zinc-800 text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors text-sm font-medium">
                                <i data-lucide="x" class="w-3 h-3"></i>
                                Reset Filter
                            </a>
                        @endif
                    </form>
                </aside>

                <!-- Novel Grid -->
                <main class="flex-1">
                    @if($novels->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($novels as $novel)
                                <a href="{{ route('novel.show', $novel) }}" class="group block animate-fade-in-up"
                                    style="animation-delay: {{ $loop->index * 0.05 }}s">
                                    <div
                                        class="relative aspect-[2/3] rounded-lg overflow-hidden bg-zinc-900 border border-zinc-800 transition-all group-hover:border-indigo-500/50 group-hover:shadow-2xl group-hover:shadow-indigo-500/10">
                                        <div class="absolute inset-0 bg-zinc-800 animate-pulse"></div>
                                        <!-- Loading skeleton placeholder -->
                                        <img src="{{ $novel->cover_image ? Storage::url($novel->cover_image) : 'https://placehold.co/300x450/09090b/27272a?text=' . urlencode($novel->title) }}"
                                            alt="{{ $novel->title }}"
                                            class="relative w-full h-full object-cover transition duration-500 group-hover:scale-105 z-10">

                                        <!-- Overlay Gradient -->
                                        <div
                                            class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-zinc-950 via-zinc-950/50 to-transparent opacity-80 z-20">
                                        </div>

                                        <!-- Tags -->
                                        <div class="absolute top-2 left-2 z-30">
                                            <span
                                                class="bg-black/60 backdrop-blur-md text-[10px] font-bold text-white px-2 py-0.5 rounded border border-white/10 uppercase tracking-wider">
                                                {{ $novel->genre->name }}
                                            </span>
                                        </div>

                                        <!-- Stats Overlay -->
                                        <div class="absolute bottom-3 left-3 right-3 z-30">
                                            <div class="flex items-center gap-3 text-[11px] font-medium text-zinc-300">
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="eye" class="w-3 h-3 text-zinc-500"></i>
                                                    {{ number_format($novel->total_views) }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="star" class="w-3 h-3 text-amber-500 fill-amber-500"></i>
                                                    {{ number_format($novel->average_rating, 1) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3
                                            class="text-sm font-bold text-zinc-100 line-clamp-1 group-hover:text-indigo-400 transition-colors">
                                            {{ $novel->title }}</h3>
                                        <div class="flex items-center gap-1 mt-1 text-xs text-zinc-500">
                                            <i data-lucide="user" class="w-3 h-3"></i>
                                            <span class="truncate">{{ $novel->author->name ?? 'Unknown' }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12 bg-zinc-900/30 rounded-xl p-4 border border-zinc-800">
                            {{ $novels->links() }}
                        </div>
                    @else
                        <div
                            class="flex flex-col items-center justify-center py-24 text-center bg-zinc-900/30 rounded-2xl border border-dashed border-zinc-800">
                            <div
                                class="w-20 h-20 bg-zinc-900 rounded-full flex items-center justify-center mb-6 border border-zinc-800">
                                <i data-lucide="search-x" class="w-10 h-10 text-zinc-600"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Novel Tidak Ditemukan</h3>
                            <p class="text-zinc-500 max-w-sm mx-auto">Coba ubah filter atau kata kunci pencarian Anda untuk
                                menemukan novel yang lain.</p>
                            @if(request()->hasAny(['search', 'genre', 'category', 'sort']))
                                <a href="{{ route('explore') }}"
                                    class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 bg-zinc-100 hover:bg-white text-zinc-900 rounded-full font-bold transition-all text-sm">
                                    Reset Pencarian
                                </a>
                            @endif
                        </div>
                    @endif
                </main>
            </div>
        </div>
    </div>

    <!-- Styles and Scripts -->
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 20px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
        }

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
            0% {
                opacity: 1;
                transform: rotate(-45deg) translateX(0);
            }

            70% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: rotate(-45deg) translateX(-1000px);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) window.lucide.createIcons();

            const container = document.getElementById('meteors-container');
            const meteorCount = 15;

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

            for (let i = 0; i < meteorCount; i++) {
                createMeteor();
            }
        });
    </script>
@endsection