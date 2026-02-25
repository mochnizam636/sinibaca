@extends('admin.layouts.app')

@section('title', 'Novel Details')

@section('content')
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.novels.index') }}" 
           class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Novel Details</h2>
            <div class="flex items-center gap-2 text-sm text-zinc-400">
                <span>Manage</span>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="font-medium text-white">{{ $novel->title }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Sidebar: Novel Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Main Info Card -->
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm">
                <div class="p-6">
                    <!-- Cover Image -->
                    <div class="mb-6 relative group">
                        <div class="aspect-[2/3] w-full rounded-lg overflow-hidden border border-zinc-800 bg-zinc-950 relative shadow-xl">
                            @if($novel->cover_image)
                                <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-zinc-600 bg-zinc-900">
                                    <i data-lucide="image" class="w-12 h-12 mb-2 opacity-50"></i>
                                    <span class="text-xs">No Cover</span>
                                </div>
                            @endif

                             <!-- Status Badge Overlay -->
                             <div class="absolute top-2 right-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold backdrop-blur-md border shadow-sm
                                    {{ $novel->status === 'published' ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' : 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30' }}">
                                    {{ ucfirst($novel->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <h2 class="text-xl font-bold text-white mb-1 leading-tight">{{ $novel->title }}</h2>
                    <p class="text-sm text-zinc-400 mb-6">by {{ $novel->author->name ?? 'Unknown Author' }}</p>

                    <!-- Meta Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="p-3 rounded-lg bg-zinc-950/50 border border-zinc-800">
                            <span class="block text-xs text-zinc-500 mb-1">Genre</span>
                            <span class="font-medium text-zinc-200">{{ $novel->genre->name ?? '-' }}</span>
                        </div>
                        <div class="p-3 rounded-lg bg-zinc-950/50 border border-zinc-800">
                            <span class="block text-xs text-zinc-500 mb-1">Category</span>
                            <span class="font-medium text-zinc-200">{{ $novel->category->name ?? '-' }}</span>
                        </div>
                        <div class="p-3 rounded-lg bg-zinc-950/50 border border-zinc-800">
                            <span class="block text-xs text-zinc-500 mb-1">Total Views</span>
                            <span class="font-medium text-zinc-200">{{ number_format($novel->total_views) }}</span>
                        </div>
                        <div class="p-3 rounded-lg bg-zinc-950/50 border border-zinc-800">
                             <span class="block text-xs text-zinc-500 mb-1">Chapters</span>
                            <span class="font-medium text-zinc-200">{{ $novel->chapters->count() }}</span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        <a href="{{ route('admin.novels.edit', $novel) }}"
                            class="flex items-center justify-center gap-2 w-full py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg font-medium transition-all shadow-lg shadow-indigo-600/20">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                            Edit Details
                        </a>
                        <a href="{{ route('admin.chapters.create', $novel) }}"
                            class="flex items-center justify-center gap-2 w-full py-2.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 rounded-lg font-medium transition-all border border-zinc-700">
                            <i data-lucide="upload-cloud" class="w-4 h-4"></i>
                            Upload Chapters
                        </a>
                        <a href="{{ route('novel.show', $novel) }}" target="_blank"
                            class="flex items-center justify-center gap-2 w-full py-2.5 text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg font-medium transition-all">
                            <i data-lucide="external-link" class="w-4 h-4"></i>
                            View on Website
                        </a>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            @if($novel->description)
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm p-6">
                    <h3 class="font-semibold text-white mb-3 flex items-center gap-2">
                        <i data-lucide="align-left" class="w-4 h-4 text-zinc-500"></i>
                        Synopsis
                    </h3>
                    <div class="prose prose-invert prose-sm max-w-none text-zinc-400 leading-relaxed custom-scrollbar max-h-60 overflow-y-auto">
                        {{ $novel->description }}
                    </div>
                </div>
            @endif
        </div>

        <!-- Main Content: Chapters List -->
        <div class="lg:col-span-2">
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm flex flex-col h-full">
                <!-- Header -->
                <div class="p-6 border-b border-zinc-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-white flex items-center gap-2">
                            <i data-lucide="list" class="w-5 h-5 text-indigo-400"></i>
                            Chapter List
                        </h3>
                        <p class="text-sm text-zinc-400 mt-1">Manage and organize chapters.</p>
                    </div>
                    <a href="{{ route('admin.chapters.create', $novel) }}"
                        class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-white text-xs font-medium rounded-lg border border-zinc-700 transition-colors flex items-center gap-2">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i>
                        Add Chapter
                    </a>
                </div>

                <!-- List -->
                <div class="flex-1">
                    @if($novel->chapters->count() > 0)
                        <div class="divide-y divide-zinc-800 border-b border-zinc-800">
                            @foreach($novel->chapters as $chapter)
                                <div class="group p-4 flex items-center justify-between hover:bg-zinc-800/50 transition-colors">
                                    <div class="flex items-center gap-4 min-w-0">
                                        <div class="w-10 h-10 rounded-lg bg-zinc-950 border border-zinc-800 flex items-center justify-center shrink-0 font-mono text-sm font-bold text-zinc-500 group-hover:text-indigo-400 group-hover:border-indigo-500/30 transition-colors">
                                            {{ $chapter->chapter_number }}
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-medium text-zinc-200 truncate pr-4 group-hover:text-white transition-colors">
                                                {{ $chapter->title }}
                                            </h4>
                                            <div class="flex items-center gap-3 text-xs text-zinc-500 mt-0.5">
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="calendar" class="w-3 h-3"></i>
                                                    {{ $chapter->created_at->format('M d, Y') }}
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="eye" class="w-3 h-3"></i>
                                                    {{ number_format($chapter->views) }}
                                                </span>
                                                @if($chapter->is_premium)
                                                    <span class="flex items-center gap-1 text-amber-500 font-medium bg-amber-500/10 px-1.5 py-0.5 rounded border border-amber-500/20">
                                                        <i data-lucide="lock" class="w-3 h-3"></i>
                                                        Premium
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('admin.chapters.edit', [$novel, $chapter]) }}"
                                           class="p-2 text-zinc-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-colors" title="Edit Chapter">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.chapters.destroy', [$novel, $chapter]) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this chapter?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-zinc-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Delete Chapter">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-16 text-zinc-500">
                            <div class="w-16 h-16 rounded-full bg-zinc-900 flex items-center justify-center mb-4">
                                <i data-lucide="file-plus" class="w-8 h-8 opacity-50"></i>
                            </div>
                            <h3 class="text-lg font-medium text-zinc-300">No chapters yet</h3>
                            <p class="text-sm max-w-xs text-center mt-2 mb-6">Start managing this novel by uploading chapters.</p>
                            <a href="{{ route('admin.chapters.create', $novel) }}"
                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg shadow-lg shadow-indigo-600/20 transition-all">
                                Upload First Chapter
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection