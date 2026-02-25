@extends('admin.layouts.app')

@section('title', 'Manage Novels')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">Novels</h2>
                <p class="text-sm text-zinc-400 mt-1">Create, edit, and manage your novel collection.</p>
            </div>
            <a href="{{ route('admin.novels.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition-colors shadow-lg shadow-indigo-600/20">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add New Novel
            </a>
        </div>

        <!-- Content -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-900/50">
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Novel</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Genre</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Stats</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider text-right">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse($novels as $novel)
                            <tr class="group hover:bg-zinc-800/50 transition-colors">
                                <!-- Novel Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-16 rounded-md bg-zinc-800 border border-zinc-700 overflow-hidden shrink-0 shadow-sm relative group-hover:shadow-md transition-shadow">
                                            @if($novel->cover_image)
                                                <img src="{{ Storage::url($novel->cover_image) }}" alt="{{ $novel->title }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                                    <i data-lucide="image" class="w-5 h-5"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('admin.novels.show', $novel) }}"
                                                class="font-bold text-white hover:text-indigo-400 transition-colors line-clamp-1 text-sm block mb-0.5">
                                                {{ $novel->title }}
                                            </a>
                                            <p class="text-xs text-zinc-500">
                                                Created {{ $novel->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Author -->
                                <td class="px-6 py-4 text-sm text-zinc-300">
                                    {{ $novel->author->name ?? 'Unknown' }}
                                </td>

                                <!-- Genre -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-zinc-800 text-zinc-300 border border-zinc-700">
                                        {{ $novel->genre->name ?? 'Uncategorized' }}
                                    </span>
                                </td>

                                <!-- Stats -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-1.5 text-xs text-zinc-400">
                                            <i data-lucide="file-text" class="w-3 h-3"></i>
                                            <span>{{ $novel->chapters_count }} Chapters</span>
                                        </div>
                                        <div class="flex items-center gap-1.5 text-xs text-zinc-400">
                                            <i data-lucide="eye" class="w-3 h-3"></i>
                                            <span>{{ number_format($novel->total_views) }} Views</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                                {{ $novel->status === 'published' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' }}">
                                        {{ ucfirst($novel->status) }}
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.novels.show', $novel) }}"
                                            class="p-2 text-zinc-400 hover:text-white hover:bg-zinc-700 rounded-lg transition-colors"
                                            title="View Details">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>

                                        <a href="{{ route('admin.novels.edit', $novel) }}"
                                            class="p-2 text-zinc-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-colors"
                                            title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('admin.novels.destroy', $novel) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this novel? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-zinc-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors"
                                                title="Delete">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-zinc-500">
                                        <i data-lucide="book-open" class="w-12 h-12 mb-3 opacity-50"></i>
                                        <p class="text-base font-medium text-zinc-400">No novels available</p>
                                        <p class="text-sm mt-1">Start by adding your first novel.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($novels->hasPages())
            <div class="mt-4">
                {{ $novels->links() }}
            </div>
        @endif
    </div>
@endsection