@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')

@section('content')
    <!-- Background Glow -->
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-purple-500/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 space-y-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Novels -->
            <div
                class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800 shadow-sm hover:border-zinc-700 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-zinc-400">Total Novels</p>
                    <div
                        class="p-2 rounded-lg bg-indigo-500/10 text-indigo-400 group-hover:bg-indigo-500/20 transition-colors">
                        <i data-lucide="book-open" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ number_format($stats['total_novels']) }}
                    </h3>
                </div>
            </div>

            <!-- Total Chapters -->
            <div
                class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800 shadow-sm hover:border-zinc-700 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-zinc-400">Total Chapters</p>
                    <div
                        class="p-2 rounded-lg bg-purple-500/10 text-purple-400 group-hover:bg-purple-500/20 transition-colors">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ number_format($stats['total_chapters']) }}
                    </h3>
                </div>
            </div>

            <!-- Total Users -->
            <div
                class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800 shadow-sm hover:border-zinc-700 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-zinc-400">Active Users</p>
                    <div
                        class="p-2 rounded-lg bg-emerald-500/10 text-emerald-400 group-hover:bg-emerald-500/20 transition-colors">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ number_format($stats['total_users']) }}</h3>
                </div>
            </div>

            <!-- Total Authors -->
            <div
                class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800 shadow-sm hover:border-zinc-700 transition-all group">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-sm font-medium text-zinc-400">Authors</p>
                    <div class="p-2 rounded-lg bg-pink-500/10 text-pink-400 group-hover:bg-pink-500/20 transition-colors">
                        <i data-lucide="pen-tool" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-bold text-white tracking-tight">{{ number_format($stats['total_authors']) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Secondary Stats & Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Novel Status Distribution -->
            <div class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800">
                <h3 class="text-base font-semibold text-white mb-6 flex items-center gap-2">
                    <i data-lucide="pie-chart" class="w-4 h-4 text-zinc-500"></i> Novel Status
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg bg-zinc-900/50 border border-zinc-800/50">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
                            <span class="text-sm font-medium text-zinc-300">Published</span>
                        </div>
                        <span class="text-sm font-bold text-white">{{ $stats['published_novels'] }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg bg-zinc-900/50 border border-zinc-800/50">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.5)]"></div>
                            <span class="text-sm font-medium text-zinc-300">Draft / Review</span>
                        </div>
                        <span class="text-sm font-bold text-white">{{ $stats['draft_novels'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Metadata Stats -->
            <div class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800">
                <h3 class="text-base font-semibold text-white mb-6 flex items-center gap-2">
                    <i data-lucide="tags" class="w-4 h-4 text-zinc-500"></i> Content Metadata
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-lg bg-zinc-900/80 border border-zinc-800 text-center">
                        <span class="block text-2xl font-bold text-white mb-1">{{ $stats['total_genres'] }}</span>
                        <span class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Genres</span>
                    </div>
                    <div class="p-4 rounded-lg bg-zinc-900/80 border border-zinc-800 text-center">
                        <span class="block text-2xl font-bold text-white mb-1">{{ $stats['total_categories'] }}</span>
                        <span class="text-xs text-zinc-500 uppercase tracking-wider font-semibold">Categories</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="p-6 rounded-xl bg-gradient-to-br from-indigo-900/20 to-purple-900/20 border border-indigo-500/20">
                <h3 class="text-base font-semibold text-white mb-6 flex items-center gap-2">
                    <i data-lucide="zap" class="w-4 h-4 text-indigo-400"></i> Quick Actions
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.novels.create') }}"
                        class="flex items-center justify-center gap-2 w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-medium transition-all shadow-lg shadow-indigo-600/20 group">
                        <i data-lucide="plus-circle" class="w-4 h-4 group-hover:scale-110 transition-transform"></i>
                        Add New Novel
                    </a>
                    <a href="{{ route('admin.authors.create') }}"
                        class="flex items-center justify-center gap-2 w-full py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 hover:text-white rounded-lg font-medium transition-all border border-zinc-700">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Add New Author
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Data Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Latest Novels -->
            <div class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800 flex flex-col h-full">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">Latest Novels</h3>
                    <a href="{{ route('admin.novels.index') }}"
                        class="text-xs font-medium text-indigo-400 hover:text-indigo-300 transition-colors">View All</a>
                </div>

                <div class="flex-1 overflow-x-auto">
                    @if($latestNovels->count() > 0)
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-zinc-800/50">
                                @foreach($latestNovels as $novel)
                                    <tr class="group">
                                        <td class="py-3 pr-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-14 rounded-md bg-zinc-800 overflow-hidden shrink-0 border border-zinc-700/50">
                                                    @if($novel->cover_image)
                                                        <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                                            <i data-lucide="book" class="w-4 h-4"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.novels.show', $novel) }}"
                                                        class="font-medium text-zinc-200 group-hover:text-indigo-400 transition-colors line-clamp-1 block max-w-[150px] sm:max-w-[200px]">{{ $novel->title }}</a>
                                                    <span
                                                        class="text-xs text-zinc-500">{{ $novel->author->name ?? 'Unknown' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 text-right">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $novel->status === 'published' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' }}">
                                                {{ ucfirst($novel->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="h-full flex flex-col items-center justify-center text-zinc-500 py-8">
                            <i data-lucide="inbox" class="w-8 h-8 mb-2 opacity-50"></i>
                            <p class="text-sm">No novels found.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Latest Users -->
            <div class="p-6 rounded-xl bg-zinc-900/50 border border-zinc-800 flex flex-col h-full">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-white">Latest Users</h3>
                    <span class="text-xs font-medium text-zinc-500">Real-time</span>
                </div>

                <div class="flex-1 overflow-x-auto">
                    @if($latestUsers->count() > 0)
                        <div class="space-y-4">
                            @foreach($latestUsers as $user)
                                <div class="flex items-center gap-4 bg-zinc-900/30 p-3 rounded-lg border border-zinc-800/30">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold shadow-lg shadow-indigo-500/20 shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-semibold text-zinc-200 truncate">{{ $user->name }}</h4>
                                        <p class="text-xs text-zinc-500 truncate">{{ $user->email }}</p>
                                    </div>
                                    <span
                                        class="text-[10px] font-medium text-zinc-500 whitespace-nowrap bg-zinc-800/50 px-2 py-1 rounded-md">
                                        {{ $user->created_at->diffForHumans(null, true) }} ago
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="h-full flex flex-col items-center justify-center text-zinc-500 py-8">
                            <i data-lucide="users" class="w-8 h-8 mb-2 opacity-50"></i>
                            <p class="text-sm">No users registered yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection