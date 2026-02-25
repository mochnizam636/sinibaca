@extends('layouts.user')

@section('title', $novel->title)
@section('description', Str::limit(strip_tags($novel->description), 160))

@section('content')
    <div class="relative min-h-[calc(100vh-4rem)]">
        <!-- Meteor Effect Container -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div id="meteors-container" class="absolute inset-0 w-full h-full"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/90 via-zinc-950/80 to-zinc-950"></div>
        </div>

        <!-- Background Cover Blur -->
        @if($novel->cover_image)
            <div class="absolute inset-x-0 top-0 h-[500px] z-0 overflow-hidden opacity-20 pointer-events-none">
                <img src="{{ Storage::url($novel->cover_image) }}" class="w-full h-full object-cover blur-3xl scale-110">
                <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/50 to-zinc-950"></div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">
            <div class="flex flex-col lg:flex-row gap-10">

                <!-- Left Column: Cover & Actions -->
                <div class="lg:w-80 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <!-- Cover Image -->
                        <div
                            class="aspect-[2/3] rounded-xl overflow-hidden bg-zinc-900 border border-zinc-800 shadow-2xl relative group">
                            @if($novel->cover_image)
                                <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                                    class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-zinc-800">
                                    <i data-lucide="book" class="w-16 h-16 text-zinc-700"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 ring-1 ring-inset ring-white/10 rounded-xl pointer-events-none">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            @if($novel->chapters->count() > 0)
                                @if($readingHistory && $readingHistory->chapter)
                                    <a href="{{ route('reader.show', [$novel, $readingHistory->chapter]) }}"
                                        class="w-full py-3.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 transition-all flex items-center justify-center gap-2 group">
                                        <i data-lucide="book-open" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                                        <span>Lanjut Ch. {{ $readingHistory->chapter->chapter_number }}</span>
                                    </a>
                                @else
                                    <a href="{{ route('reader.show', [$novel, $novel->chapters->first()]) }}"
                                        class="w-full py-3.5 rounded-xl font-bold text-white bg-indigo-600 hover:bg-indigo-500 shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 transition-all flex items-center justify-center gap-2 group">
                                        <i data-lucide="play" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                                        <span>Mulai Baca</span>
                                    </a>
                                @endif
                            @endif

                            @auth
                                                <div class="grid grid-cols-2 gap-3">
                                                    <form
                                                        action="{{ $isBookmarked ? route('library.bookmark.remove', $novel) : route('library.bookmark.add', $novel) }}"
                                                        method="POST">
                                                        @csrf
                                                        @if($isBookmarked) @method('DELETE') @endif
                                                        <button type="submit" class="w-full py-3 rounded-xl font-medium border transition-all flex flex-col items-center justify-center gap-1.5
                                                                {{ $isBookmarked
                                ? 'bg-zinc-800 text-white border-zinc-700 hover:bg-zinc-700'
                                : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:bg-zinc-900 hover:text-white hover:border-zinc-700' 
                                                                }}">
                                                            <i data-lucide="bookmark"
                                                                class="w-5 h-5 {{ $isBookmarked ? 'fill-current' : '' }}"></i>
                                                            <span class="text-xs">{{ $isBookmarked ? 'Disimpan' : 'Simpan' }}</span>
                                                        </button>
                                                    </form>

                                                    <form
                                                        action="{{ $isInReadlist ? route('library.readlist.remove', $novel) : route('library.readlist.add', $novel) }}"
                                                        method="POST">
                                                        @csrf
                                                        @if($isInReadlist) @method('DELETE') @endif
                                                        <button type="submit" class="w-full py-3 rounded-xl font-medium border transition-all flex flex-col items-center justify-center gap-1.5
                                                                {{ $isInReadlist
                                ? 'bg-pink-900/20 text-pink-400 border-pink-500/30 hover:bg-pink-900/30'
                                : 'bg-zinc-950 text-zinc-400 border-zinc-800 hover:bg-zinc-900 hover:text-white hover:border-zinc-700' 
                                                                }}">
                                                            <i data-lucide="list-plus" class="w-5 h-5"></i>
                                                            <span class="text-xs">{{ $isInReadlist ? 'Didaftar' : 'Daftar' }}</span>
                                                        </button>
                                                    </form>
                                                </div>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block w-full py-3 text-center text-sm text-zinc-500 hover:text-indigo-400 border border-dashed border-zinc-800 rounded-xl hover:border-zinc-700 transition">
                                    Login untuk fitur library
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Right Column: Details & Content -->
                <div class="flex-1 space-y-10">

                    <!-- Header Info -->
                    <div class="space-y-6">
                        <div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span
                                    class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 uppercase tracking-wider">
                                    {{ $novel->genre->name }}
                                </span>
                                <span
                                    class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-zinc-800 text-zinc-400 border border-zinc-700 uppercase tracking-wider">
                                    {{ $novel->category->name }}
                                </span>
                                <span
                                    {{ ucfirst($novel->status) }}
                                </span>
                                @if($novel->is_premium)
                                    <span
                                        class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 uppercase tracking-wider flex items-center gap-1">
                                        <i data-lucide="crown" class="w-3 h-3"></i> Premium
                                    </span>
                                @endif
                            </div>

                            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight leading-tight mb-4">
                                {{ $novel->title }}
                            </h1>

                            <div class="flex flex-wrap items-center gap-6 text-sm">
                                <a href="#" class="flex items-center gap-2 group">
                                    <div
                                        class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                        <i data-lucide="user" class="w-4 h-4"></i>
                                    </div>
                                    <span
                                        class="font-medium text-zinc-300 group-hover:text-white transition-colors">{{ $novel->author->name }}</span>
                                </a>

                                <div class="w-px h-4 bg-zinc-800"></div>

                                <div class="flex items-center gap-1.5 text-zinc-400">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                    <span>{{ number_format($novel->total_views) }} Views</span>
                                </div>

                                <div class="w-px h-4 bg-zinc-800"></div>

                                <div class="flex items-center gap-1 text-amber-400 font-bold">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <span>{{ number_format($novel->average_rating, 1) }}</span>
                                    <span class="text-zinc-500 font-normal ml-1">({{ $novel->reviews->count() }})</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabs (Visual only via divs) -->
                    <div class="space-y-8">
                        <!-- Sinopsis -->
                        <section>
                            <h3 class="flex items-center gap-2 text-lg font-bold text-white mb-4">
                                <i data-lucide="align-left" class="w-5 h-5 text-indigo-500"></i>
                                Sinopsis
                            </h3>
                            <div class="prose prose-invert prose-zinc max-w-none">
                                <div
                                    class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-xl p-6 text-zinc-300 leading-relaxed whitespace-pre-line shadow-sm">
                                    {{ $novel->description ?? 'Tidak ada sinopsis yang tersedia.' }}
                                </div>
                            </div>
                        </section>

                        <!-- Chapters -->
                        <section>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                                <h3 class="flex items-center gap-2 text-lg font-bold text-white">
                                    <i data-lucide="layers" class="w-5 h-5 text-indigo-500"></i>
                                    Daftar Chapter <span
                                        class="text-zinc-500 text-sm font-normal">({{ $novel->chapters->count() }})</span>
                                </h3>
                                <div class="relative w-full sm:w-64">
                                    <i data-lucide="search"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-500"></i>
                                    <input type="text" id="chapterSearch" placeholder="Cari chapter..."
                                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg pl-9 pr-4 py-2 text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all">
                                </div>
                            </div>

                            <div
                                class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-xl overflow-hidden max-h-[500px] overflow-y-auto custom-scrollbar">
                                @if($novel->chapters->count() > 0)
                                    <div class="divide-y divide-zinc-800/50" id="chapterList">
                                        @foreach($novel->chapters as $chapter)
                                            @php
                                                $isRead = isset($lastReadChapterNumber) && $chapter->chapter_number <= $lastReadChapterNumber;
                                            @endphp
                                            <div class="chapter-item hover:bg-zinc-800/30 transition-colors {{ $isRead ? 'bg-emerald-900/10' : '' }}"
                                                data-title="{{ strtolower($chapter->title) }}"
                                                data-number="{{ $chapter->chapter_number }}">
                                                <a href="{{ route('reader.show', [$novel, $chapter]) }}"
                                                    class="flex items-center justify-between p-4 group">
                                                    <div class="flex items-center gap-4">
                                                        <span
                                                            class="w-8 h-8 flex-shrink-0 flex items-center justify-center rounded font-mono text-sm transition-colors {{ $isRead ? 'bg-emerald-500 text-white' : 'bg-zinc-800 text-zinc-400 group-hover:bg-indigo-600 group-hover:text-white' }}">
                                                            @if($isRead)
                                                                <i data-lucide="check" class="w-4 h-4"></i>
                                                            @else
                                                                {{ $chapter->chapter_number }}
                                                            @endif
                                                        </span>
                                                        <div>
                                                            <h4
                                                                class="font-medium transition-colors line-clamp-1 {{ $isRead ? 'text-emerald-400' : 'text-zinc-200 group-hover:text-indigo-400' }}">
                                                                {{ $chapter->title }}
                                                                @if($chapter->is_premium)
                                                                    <span class="ml-2 text-[10px] bg-amber-500/20 text-amber-400 border border-amber-500/30 px-1.5 py-0.5 rounded">PREMIUM</span>
                                                                @endif
                                                            </h4>
                                                            <p class="text-[11px] text-zinc-500">
                                                                {{ $chapter->created_at->diffForHumans() }}</p>
                                                        </div>
                                                    </div>
                                                    <i data-lucide="chevron-right"
                                                        class="w-4 h-4 text-zinc-600 group-hover:text-white transition-colors"></i>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="noChaptersFound" class="hidden p-8 text-center text-zinc-500">
                                        Chapter tidak ditemukan.
                                    </div>
                                @else
                                    <div class="p-12 text-center text-zinc-500">
                                        <i data-lucide="file-x" class="w-8 h-8 mx-auto mb-2 opacity-50"></i>
                                        <p>Belum ada chapter.</p>
                                    </div>
                                @endif
                            </div>
                        </section>

                        <!-- Reviews -->
                        <section>
                            <h3 class="flex items-center gap-2 text-lg font-bold text-white mb-4">
                                <i data-lucide="message-square" class="w-5 h-5 text-indigo-500"></i>
                                Review Pembaca
                            </h3>

                            @auth
                                <form action="{{ route('reviews.store', $novel) }}" method="POST"
                                    class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800 rounded-xl p-6 mb-6">
                                    @csrf
                                    <div class="mb-4">
                                        <label
                                            class="block text-xs font-bold text-zinc-400 uppercase tracking-widest mb-2">Rating
                                            Kamu</label>
                                        <div class="flex gap-1" x-data="{ rating: {{ old('rating', 0) }}, hover: 0 }" @mouseleave="hover = 0">
                                            @for($i = 1; $i <= 5; $i++)
                                                <label class="cursor-pointer transition-transform hover:scale-110" 
                                                       @mouseenter="hover = {{ $i }}" 
                                                       @click="rating = {{ $i }}">
                                                    <input type="radio" name="rating" value="{{ $i }}" class="hidden" {{ old('rating') == $i ? 'checked' : '' }} required>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="w-6 h-6 transition-colors duration-200"
                                                        :class="{
                                                            'text-amber-400 fill-amber-400': (hover >= {{ $i }}) || (hover === 0 && rating >= {{ $i }}),
                                                            'text-zinc-700': !((hover >= {{ $i }}) || (hover === 0 && rating >= {{ $i }}))
                                                        }">
                                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                                    </svg>
                                                </label>
                                            @endfor
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label
                                            class="block text-xs font-bold text-zinc-400 uppercase tracking-widest mb-2">Komentar</label>
                                        <textarea name="comment" rows="3" placeholder="Bagaimana pendapatmu tentang novel ini?"
                                            class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-white placeholder-zinc-600 focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all resize-none"
                                            required></textarea>
                                    </div>
                                    <button type="submit"
                                        class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-6 py-2 rounded-lg transition-colors text-sm">
                                        Kirim Review
                                    </button>
                                </form>
                            @endauth

                            <div class="space-y-4">
                                @forelse($novel->reviews as $review)
                                    <div
                                        class="group bg-zinc-900/30 border border-zinc-800/60 rounded-xl p-5 hover:border-zinc-700 transition-all">
                                        <div class="flex items-start justify-between mb-3">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 font-bold">
                                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-zinc-200 text-sm">{{ $review->user->name }}</h4>
                                                    <div class="flex items-center gap-0.5 mt-0.5">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i data-lucide="star"
                                                                class="w-3 h-3 {{ $i <= $review->rating ? 'text-amber-400 fill-amber-400' : 'text-zinc-700' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <span
                                                class="text-xs text-zinc-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-zinc-300 text-sm leading-relaxed pl-[3.25rem]">{{ $review->comment }}</p>

                                        @if(auth()->check() && (auth()->id() === $review->user_id || auth()->user()->isAdmin()))
                                            <div class="mt-2 flex justify-end">
                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                                                    onsubmit="return confirm('Hapus review ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-xs text-red-400 hover:text-red-300 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <i data-lucide="trash-2" class="w-3 h-3"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-10 border border-dashed border-zinc-800 rounded-xl">
                                        <p class="text-zinc-500 text-sm">Belum ada review. Jadilah yang pertama!</p>
                                    </div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(24, 24, 27, 0.5);
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(63, 63, 70, 0.8);
            border-radius: 10px;
        }

        .hover-trigger .hover-target {
            display: none;
        }

        .hover-trigger:hover .hover-target {
            display: block;
        }

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

            // Chapter Search
            const searchInput = document.getElementById('chapterSearch');
            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const items = document.querySelectorAll('.chapter-item');
                    let foundCount = 0;

                    items.forEach(item => {
                        const title = item.getAttribute('data-title');
                        const number = item.getAttribute('data-number');

                        if (title.includes(searchTerm) || number.includes(searchTerm)) {
                            item.style.display = 'block';
                            foundCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    const noFoundMsg = document.getElementById('noChaptersFound');
                    const list = document.getElementById('chapterList');
                    if (noFoundMsg) {
                        if (foundCount > 0) {
                            noFoundMsg.classList.add('hidden');
                            list.classList.remove('hidden');
                        } else {
                            noFoundMsg.classList.remove('hidden');
                            list.classList.add('hidden');
                        }
                    }
                });
            }

            // Meteors
            const container = document.getElementById('meteors-container');
            if (container) {
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
                for (let i = 0; i < meteorCount; i++) createMeteor();
            }
        });
    </script>
@endsection