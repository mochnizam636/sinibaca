@extends('admin.layouts.app')

@section('title', 'Manage Authors')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
             <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">Authors</h2>
                <p class="text-sm text-zinc-400 mt-1">Manage the authors who write novels.</p>
            </div>
            <a href="{{ route('admin.authors.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition-colors shadow-lg shadow-indigo-600/20">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                Add Author
            </a>
        </div>

        <!-- Content -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-900/50">
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Bio</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider">Novels</th>
                            <th class="px-6 py-4 text-xs font-semibold text-zinc-400 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800">
                        @forelse($authors as $author)
                            <tr class="group hover:bg-zinc-800/50 transition-colors">
                                <td class="px-6 py-4 text-sm text-zinc-500 font-mono">#{{ $author->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center text-xs font-bold text-zinc-300">
                                            {{ substr($author->name, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-white">{{ $author->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-400 max-w-xs truncate">{{ Str::limit($author->bio, 50) ?: '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-800 text-zinc-300 border border-zinc-700">
                                        {{ $author->novels_count }} novels
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.authors.edit', $author) }}"
                                           class="p-2 text-zinc-400 hover:text-indigo-400 hover:bg-indigo-500/10 rounded-lg transition-colors" title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this author?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-zinc-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors" title="Delete">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-zinc-500">
                                        <i data-lucide="users" class="w-12 h-12 mb-3 opacity-50"></i>
                                        <p class="text-base font-medium text-zinc-400">No authors found</p>
                                        <p class="text-sm mt-1">Get started by adding a new author.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($authors->hasPages())
            <div class="mt-4">
                {{ $authors->links() }}
            </div>
        @endif
    </div>
@endsection