@extends('admin.layouts.app')

@section('title', 'Edit Chapter')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.novels.show', $novel) }}"
                class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">Edit Chapter</h2>
                <div class="flex items-center gap-2 text-sm text-zinc-400">
                    <span>Novel:</span>
                    <span class="font-medium text-indigo-400">{{ $novel->title }}</span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm">
            <form action="{{ route('admin.chapters.update', [$novel, $chapter]) }}" method="POST"
                class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Chapter Number -->
                    <div class="md:col-span-1 space-y-2">
                        <label for="chapter_number" class="block text-sm font-medium text-zinc-300">
                            Chapter # <span class="text-red-400">*</span>
                        </label>
                        <input type="number" name="chapter_number" id="chapter_number"
                            value="{{ old('chapter_number', $chapter->chapter_number) }}" required min="1"
                            class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                    </div>

                    <!-- Title -->
                    <div class="md:col-span-3 space-y-2">
                        <label for="title" class="block text-sm font-medium text-zinc-300">
                            Chapter Title <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $chapter->title) }}" required
                            class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                    </div>
                </div>

                <!-- Options -->
                <div class="flex items-start gap-3 p-4 rounded-lg bg-zinc-950/50 border border-zinc-800">
                    <div class="flex items-center h-5">
                        <input type="checkbox" name="is_premium" value="1" {{ old('is_premium', $chapter->is_premium) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-zinc-700 bg-zinc-900 text-indigo-600 focus:ring-indigo-500/50 focus:ring-offset-0 transition-all">
                    </div>
                    <div class="text-sm">
                        <label for="is_premium" class="font-medium text-white cursor-pointer select-none">
                            Premium Chapter
                        </label>
                        <p class="text-zinc-500 mt-0.5">Require user subscription or coins to unlock this chapter.</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="space-y-2">
                    <label for="content" class="block text-sm font-medium text-zinc-300">
                        Content <span class="text-red-400">*</span>
                    </label>
                    <textarea name="content" id="content" rows="20" required
                        class="w-full bg-zinc-950 border border-zinc-700 text-zinc-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-mono text-sm leading-relaxed outline-none resize-y">{{ old('content', $chapter->content) }}</textarea>
                </div>

                <!-- Footer Actions -->
                <div class="pt-6 border-t border-zinc-800 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.novels.show', $novel) }}"
                        class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Update Chapter
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection