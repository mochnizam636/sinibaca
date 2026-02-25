<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $chapter->title }} - {{ $novel->title }} | NovelKu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lora:400,500&family=inter:400,500,600&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --bg-reader: #0f0f1a;
            --text-reader: #e4e4e7;
        }

        body {
            background-color: var(--bg-reader);
            color: var(--text-reader);
        }

        .reader-content {
            font-family: 'Lora', Georgia, serif;
            font-size: 1.125rem;
            line-height: 1.9;
            letter-spacing: 0.02em;
        }

        .reader-content p {
            margin-bottom: 1.5em;
        }

        .gradient-text {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>

<body class="antialiased min-h-screen">
    <!-- Reader Navigation -->
    <nav class="sticky top-0 z-50 bg-[#0f0f1a]/95 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-4xl mx-auto px-4">
            <div class="flex items-center justify-between h-14">
                <a href="{{ route('novel.show', $novel) }}"
                    class="flex items-center gap-2 text-gray-400 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="hidden sm:inline">Kembali</span>
                </a>
                <div class="text-center flex-1 mx-4">
                    <h1 class="text-sm font-medium text-gray-300 truncate">{{ $novel->title }}</h1>
                    <p class="text-xs text-gray-500">{{ $chapter->title }}</p>
                </div>
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Reader Content -->
    <main class="max-w-3xl mx-auto px-4 py-12">
        <!-- Chapter Header -->
        <header class="text-center mb-12">
            <span class="text-purple-400 text-sm font-medium">Chapter {{ $chapter->chapter_number }}</span>
            <h1 class="text-2xl md:text-3xl font-bold mt-2 mb-4">{{ $chapter->title }}</h1>
            <div class="flex items-center justify-center gap-4 text-sm text-gray-500">
                <span>{{ $chapter->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span>{{ number_format($chapter->views) }} views</span>
            </div>
        </header>

        <!-- Chapter Content -->
        <article class="reader-content text-gray-300">
            {!! nl2br(e($chapter->content)) !!}
        </article>

        <!-- Chapter Navigation -->
        <nav class="mt-16 pt-8 border-t border-gray-800">
            <div class="flex items-center justify-between gap-4">
                @if($previousChapter)
                    <a href="{{ route('reader.show', [$novel, $previousChapter]) }}"
                        class="flex-1 flex items-center gap-3 p-4 bg-[#1a1a2e] rounded-xl hover:bg-[#25253a] transition group">
                        <svg class="w-6 h-6 text-gray-500 group-hover:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                        <div>
                            <span class="text-xs text-gray-500">Sebelumnya</span>
                            <p class="font-medium group-hover:text-purple-400 transition line-clamp-1">
                                {{ $previousChapter->title }}</p>
                        </div>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif

                <a href="{{ route('novel.show', $novel) }}"
                    class="p-4 bg-[#1a1a2e] rounded-xl hover:bg-[#25253a] transition" title="Daftar Chapter">
                    <svg class="w-6 h-6 text-gray-400 hover:text-white" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </a>

                @if($nextChapter)
                    <a href="{{ route('reader.show', [$novel, $nextChapter]) }}"
                        class="flex-1 flex items-center justify-end gap-3 p-4 bg-[#1a1a2e] rounded-xl hover:bg-[#25253a] transition group text-right">
                        <div>
                            <span class="text-xs text-gray-500">Selanjutnya</span>
                            <p class="font-medium group-hover:text-purple-400 transition line-clamp-1">
                                {{ $nextChapter->title }}</p>
                        </div>
                        <svg class="w-6 h-6 text-gray-500 group-hover:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                @else
                    <div class="flex-1"></div>
                @endif
            </div>

            <!-- End of Chapter Message -->
            @if(!$nextChapter)
                <div
                    class="mt-8 text-center p-8 bg-gradient-to-r from-purple-900/30 to-pink-900/30 rounded-2xl border border-purple-500/20">
                    <h3 class="text-xl font-bold mb-2">🎉 Selesai!</h3>
                    <p class="text-gray-400 mb-4">Anda telah menyelesaikan chapter terakhir dari novel ini.</p>
                    <a href="{{ route('novel.show', $novel) }}" class="text-purple-400 hover:text-purple-300">← Kembali ke
                        Detail Novel</a>
                </div>
            @endif
        </nav>
    </main>
</body>

</html>