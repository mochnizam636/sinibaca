@extends('layouts.user')

@section('title', 'SiniBaca - Platform Baca Novel Terpercaya')

@section('content')
    <div class="relative min-h-[calc(100vh-4rem)] bg-zinc-950">
        <!-- Meteor Effect Container -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div id="meteors-container" class="absolute inset-0 w-full h-full"></div>
            <!-- Radial Gradient for depth -->
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/80 via-zinc-950/50 to-zinc-950"></div>
        </div>

        <!-- Hero Slider Section -->
        <section class="relative z-10 overflow-hidden border-b border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
                <div
                    class="swiper hero-swiper rounded-xl border border-zinc-800 bg-zinc-900/60 backdrop-blur-sm shadow-2xl overflow-hidden animate-fade-in-up">
                    <div class="swiper-wrapper">
                        @foreach ($recommended->take(3) as $novel)
                            <div class="swiper-slide p-6 md:p-8">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
                                    <!-- Content -->
                                    <div class="md:col-span-8 order-2 md:order-1 space-y-4 md:pl-12">
                                        <div class="flex items-center gap-2 animate-slide-in-left"
                                            style="animation-delay: 0.1s;">
                                            <div
                                                class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-wider shadow-[0_0_10px_rgba(99,102,241,0.3)]">
                                                Featured
                                            </div>
                                            <div class="w-1 h-1 bg-zinc-700 rounded-full"></div>
                                            <span
                                                class="text-xs font-medium text-zinc-400 uppercase tracking-widest">{{ $novel->genre->name }}</span>
                                        </div>

                                        <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight line-clamp-2 animate-slide-in-left"
                                            style="animation-delay: 0.2s;">
                                            {{ $novel->title }}
                                        </h1>

                                        <div class="flex items-center gap-4 text-xs font-medium text-zinc-500 animate-slide-in-left"
                                            style="animation-delay: 0.3s;">
                                            <div class="flex items-center gap-1.5">
                                                <i data-lucide="user" class="w-3.5 h-3.5"></i>
                                                <span class="text-zinc-300">{{ $novel->author->name }}</span>
                                            </div>
                                            <div class="w-px h-3 bg-zinc-800"></div>
                                            <div class="flex items-center gap-1.5">
                                                <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500 fill-amber-500"></i>
                                                <span
                                                    class="text-zinc-300">{{ number_format($novel->average_rating ?? 4.8, 1) }}</span>
                                            </div>
                                        </div>

                                        <p class="text-zinc-400 text-sm md:text-base max-w-xl line-clamp-2 leading-relaxed animate-fade-in"
                                            style="animation-delay: 0.4s;">
                                            {{ $novel->description ?? 'Tidak ada deskripsi untuk novel ini.' }}
                                        </p>

                                        <div class="flex items-center gap-3 pt-2 animate-fade-in-up"
                                            style="animation-delay: 0.5s;">
                                            <a href="{{ route('novel.show', $novel) }}"
                                                class="inline-flex h-9 items-center justify-center rounded-md bg-white px-4 py-2 text-sm font-medium text-zinc-900 transition-all hover:bg-zinc-200 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:ring-offset-2 shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                                                Baca Sekarang
                                            </a>
                                            @auth
                                                <form action="{{ route('library.bookmark.add', $novel) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex h-9 items-center justify-center rounded-md border border-zinc-800 bg-transparent px-4 py-2 text-sm font-medium text-white transition-all hover:bg-zinc-800 hover:border-zinc-700 focus:outline-none focus:ring-2 focus:ring-zinc-400 focus:ring-offset-2">
                                                        Library
                                                    </button>
                                                </form>
                                            @endauth
                                        </div>
                                    </div>

                                    <!-- Cover -->
                                    <div
                                        class="md:col-span-4 order-1 md:order-2 flex justify-center md:justify-end animate-float md:pr-12">
                                        <div
                                            class="relative w-32 md:w-40 aspect-[2/3] rounded-md shadow-2xl border border-zinc-800 overflow-hidden bg-zinc-800 rotate-3 hover:rotate-0 transition-all duration-500 group">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-tr from-indigo-500/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10">
                                            </div>
                                            <img src="{{ $novel->cover_image ? Storage::url($novel->cover_image) : 'https://placehold.co/400x600/09090b/27272a?text=' . urlencode($novel->title) }}"
                                                alt="{{ $novel->title }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Simple Navigation -->
                    <div
                        class="hidden md:flex absolute top-1/2 -translate-y-1/2 justify-between w-full px-4 z-10 pointer-events-none">
                        <button
                            class="hero-prev pointer-events-auto h-8 w-8 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center backdrop-blur-sm transition-all border border-white/10 hover:scale-110 active:scale-95">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <button
                            class="hero-next pointer-events-auto h-8 w-8 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center backdrop-blur-sm transition-all border border-white/10 hover:scale-110 active:scale-95">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16 relative z-10">

            <!-- Recommended Section -->
            <section class="animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
                        <h2 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
                            Novel Terpopuler
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                            </span>
                        </h2>
                        <p class="text-sm text-zinc-500">Novel dengan pembaca terbanyak dan rating tertinggi.</p>
                    </div>
                    <a href="{{ route('explore') }}"
                        class="text-xs font-medium text-zinc-500 hover:text-white transition-colors flex items-center gap-1 group">
                        Lihat Semua <i data-lucide="arrow-right"
                            class="w-3 h-3 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
                    @foreach ($recommended->skip(3) as $novel)
                        <a href="{{ route('novel.show', $novel) }}"
                            class="group block space-y-2 hover:-translate-y-1.5 transition-transform duration-300">
                            <div
                                class="relative aspect-[2/3] rounded-md overflow-hidden bg-zinc-900 border border-zinc-800 transition-all group-hover:border-zinc-600 group-hover:shadow-[0_0_20px_rgba(99,102,241,0.15)]">
                                <img src="{{ $novel->cover_image ? Storage::url($novel->cover_image) : 'https://placehold.co/300x450/09090b/27272a?text=' . urlencode($novel->title) }}"
                                    alt="{{ $novel->title }}"
                                    class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-60 group-hover:opacity-40 transition-opacity">
                                </div>
                                <div class="absolute top-2 left-2">
                                    <span
                                        class="bg-black/70 backdrop-blur-md text-[9px] font-bold text-white px-1.5 py-0.5 rounded border border-white/10 uppercase">
                                        {{ $novel->genre->name }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h3
                                    class="text-sm font-semibold text-zinc-100 line-clamp-1 group-hover:text-indigo-400 transition-colors">
                                    {{ $novel->title }}</h3>
                                <p class="text-xs text-zinc-500 truncate">{{ $novel->author->name }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Latest Updates (Grid Card Style) -->
            <section class="animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-white tracking-tight">Update Terbaru</h2>
                        <p class="text-sm text-zinc-500">Bab terbaru yang baru saja rilis.</p>
                    </div>
                    <a href="{{ route('explore') }}?sort=latest"
                        class="text-xs font-medium text-zinc-500 hover:text-white transition-colors flex items-center gap-1 group">
                        Lihat Semua <i data-lucide="arrow-right"
                            class="w-3 h-3 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($latestUpdates as $novel)
                        <a href="{{ route('novel.show', $novel) }}"
                            class="flex gap-4 p-3 rounded-lg border border-zinc-800 bg-zinc-900/40 hover:bg-zinc-900 hover:border-zinc-700 transition-all group hover:shadow-lg hover:-translate-x-1 backdrop-blur-sm">
                            <div class="shrink-0 w-16 h-24 rounded overflow-hidden border border-zinc-800 bg-zinc-800 relative">
                                <img src="{{ $novel->cover_image ? Storage::url($novel->cover_image) : 'https://placehold.co/200x300/09090b/27272a?text=' . urlencode($novel->title) }}"
                                    alt="{{ $novel->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 min-w-0 py-0.5">
                                <div class="mb-auto">
                                    <h3
                                        class="text-sm font-bold text-zinc-100 line-clamp-1 group-hover:text-indigo-400 transition-colors">
                                        {{ $novel->title }}
                                    </h3>
                                    <p class="text-xs text-zinc-400 line-clamp-2 leading-relaxed mt-1">
                                        {{ Str::limit($novel->description, 60) }}
                                    </p>
                                </div>
                                <div class="flex items-center justify-between pt-2 border-t border-zinc-800/50 mt-2">
                                    <span class="text-[10px] text-zinc-500 font-medium">{{ $novel->author->name }}</span>
                                    <span class="text-[10px] text-indigo-400 font-medium flex items-center gap-1 animate-pulse">
                                        Update Baru
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <!-- Continue Reading (Auth) -->
            @auth
                @if($continueReading->isNotEmpty())
                    <section class="animate-fade-in-up" style="animation-delay: 0.6s;">
                        <div
                            class="rounded-xl border border-zinc-800 bg-gradient-to-br from-zinc-900 to-zinc-950 p-6 relative overflow-hidden">
                            <!-- Glow Effect -->
                            <div
                                class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-500/5 blur-3xl rounded-full pointer-events-none">
                            </div>

                            <div class="flex items-center gap-2 mb-6 relative z-10">
                                <i data-lucide="book-open" class="w-4 h-4 text-indigo-500"></i>
                                <h2 class="text-lg font-bold text-white">Lanjutkan Membaca</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 relative z-10">
                                @foreach ($continueReading as $item)
                                    <a href="{{ route('reader.show', [$item->novel, $item->chapter]) }}"
                                        class="group flex items-center gap-3 p-2 pr-4 rounded-lg bg-black/20 border border-zinc-800 hover:border-zinc-600 transition-all hover:bg-zinc-800/50">
                                        <div
                                            class="shrink-0 w-12 h-16 rounded overflow-hidden border border-zinc-800 relative group-hover:border-zinc-600 transition-colors">
                                            <img src="{{ $item->novel->cover_image ? Storage::url($item->novel->cover_image) : 'https://placehold.co/100x150/09090b/27272a?text=' . urlencode($item->novel->title) }}"
                                                alt="{{ $item->novel->title }}" class="w-full h-full object-cover">
                                            <div class="absolute inset-x-0 bottom-0 h-0.5 bg-zinc-700">
                                                <div class="h-full bg-indigo-500 w-3/4 group-hover:w-full transition-all duration-1000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-hidden min-w-0">
                                            <h4
                                                class="text-sm font-bold text-zinc-200 line-clamp-1 group-hover:text-white transition-colors">
                                                {{ $item->novel->title }}</h4>
                                            <p class="text-[10px] text-zinc-500 truncate mb-1">Ch. {{ $item->chapter->chapter_number }}
                                            </p>
                                            <div
                                                class="text-[10px] text-indigo-400 font-medium flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                                                Lanjut <i data-lucide="arrow-right" class="w-2.5 h-2.5"></i>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endauth
        </div>
    </div>

    <!-- Swiper Assets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Custom Styles for Animations -->
    <style>
        /* Fade In Up */
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
            animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
        }

        /* Fade In */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
        }

        /* Slide In Left */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.6s ease-out forwards;
            opacity: 0;
        }

        /* Float Animation */
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(3deg);
            }

            50% {
                transform: translateY(-10px) rotate(3deg);
            }

            100% {
                transform: translateY(0px) rotate(3deg);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float:hover {
            animation-play-state: paused;
        }

        /* Meteor Animation */
        .meteor {
            position: absolute;
            width: 300px;
            /* Reduced length for better mobile looks */
            height: 1px;
            background: linear-gradient(to right, rgba(99, 102, 241, 0) 0%, rgba(99, 102, 241, 1) 50%, rgba(99, 102, 241, 0) 100%);
            transform: rotate(-45deg);
            pointer-events: none;
            opacity: 0;
            filter: drop-shadow(0 0 6px rgba(99, 102, 241, 0.8));
        }

        .meteor::before {
            content: '';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background: #818cf8;
            border-radius: 50%;
            box-shadow: 0 0 10px 2px #818cf8;
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
                /* Travel distance */
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Swiper Init
            new Swiper('.hero-swiper', {
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.hero-next',
                    prevEl: '.hero-prev',
                },
            });

            // Lucide Init
            if (window.lucide) {
                window.lucide.createIcons();
            }

            // Meteor Generation
            const container = document.getElementById('meteors-container');
            const meteorCount = 20; // Increased count for full page

            function createMeteor() {
                const meteor = document.createElement('div');
                meteor.classList.add('meteor');

                // Random positioning
                const top = Math.random() * 100; // 0 to 100%
                const left = Math.random() * 100; // 0 to 100%
                const duration = Math.random() * 2 + 2; // 2s to 4s
                const delay = Math.random() * 5; // 0s to 5s start delay

                meteor.style.top = top + '%';
                meteor.style.left = left + '%';
                meteor.style.animation = `meteor-fall ${duration}s linear infinite`;
                meteor.style.animationDelay = delay + 's';

                container.appendChild(meteor);
            }

            // Init meteors
            for (let i = 0; i < meteorCount; i++) {
                createMeteor();
            }
        });
    </script>
@endsection