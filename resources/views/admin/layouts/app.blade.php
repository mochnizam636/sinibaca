<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - {{ config('app.name', 'NovelKu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-zinc-950 text-zinc-50 font-sans antialiased selection:bg-indigo-500/30 selection:text-indigo-400">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-zinc-900/50 backdrop-blur-xl border-r border-zinc-800 flex flex-col transition-transform duration-300 lg:translate-x-0 lg:static group"
            x-data="{ expanded: true }">

            <!-- Logo -->
            <div class="h-16 flex items-center px-6 border-b border-zinc-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    </div>
                    <span class="font-bold text-lg tracking-tight">Admin<span
                            class="text-indigo-400">Panel</span></span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
                <p class="px-2 text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2">Overview</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                    <i data-lucide="bar-chart-2" class="w-4 h-4"></i>
                    Dashboard
                </a>

                <p class="px-2 text-xs font-semibold text-zinc-500 uppercase tracking-wider mt-6 mb-2">Content</p>

                <a href="{{ route('admin.novels.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.novels.*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                    <i data-lucide="book" class="w-4 h-4"></i>
                    Novels
                </a>

                <a href="{{ route('admin.authors.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.authors.*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    Authors
                </a>

                <a href="{{ route('admin.genres.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.genres.*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                    <i data-lucide="tags" class="w-4 h-4"></i>
                    Genres
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                </a>

                <p class="px-2 text-xs font-semibold text-zinc-500 uppercase tracking-wider mt-6 mb-2">Finance</p>

                <a href="{{ route('admin.reports.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                    <i data-lucide="pie-chart" class="w-4 h-4"></i>
                    Laporan Keuangan
                </a>

                <p class="px-2 text-xs font-semibold text-zinc-500 uppercase tracking-wider mt-6 mb-2">Support</p>

                <a href="{{ route('admin.chats.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-all {{ request()->routeIs('admin.chats.*') ? 'bg-indigo-500/10 text-indigo-400' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    Live Chat
                    @php
                        $unreadChats = \App\Models\Chat::where('status', 'open')
                            ->whereHas('messages', fn($q) => $q->where('sender_type', 'user')->where('is_read', false))
                            ->count();
                    @endphp
                    @if($unreadChats > 0)
                        <span
                            class="ml-auto inline-flex items-center justify-center w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full">
                            {{ $unreadChats }}
                        </span>
                    @endif
                </a>
            </nav>

            <!-- Bottom Actions -->
            <div class="p-4 border-t border-zinc-800 bg-zinc-900/30">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800/50 transition-all mb-2">
                    <i data-lucide="globe" class="w-4 h-4"></i>
                    View Website
                </a>

                <div class="flex items-center gap-3 px-3 py-2 mt-2">
                    <div
                        class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center">
                        <span class="text-xs font-bold text-zinc-300">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-zinc-500 truncate">Admin</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-zinc-500 hover:text-red-400 transition-colors" title="Logout">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 bg-black/20">
            <!-- Header -->
            <header
                class="h-16 flex items-center justify-between px-4 sm:px-6 lg:px-8 border-b border-zinc-800 bg-zinc-950/50 backdrop-blur-sm sticky top-0 z-40">
                <h1 class="text-xl font-semibold text-white tracking-tight">@yield('title')</h1>
                <div class="flex items-center gap-4">
                    <!-- Notifications or other header items can go here -->
                    <div class="h-8 w-px bg-zinc-800 mx-2"></div>
                    <span class="text-sm text-zinc-400">{{ now()->format('l, d F Y') }}</span>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center gap-3">
                        <i data-lucide="check-circle-2" class="w-5 h-5 shrink-0"></i>
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 flex items-center gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>