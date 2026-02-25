@extends('admin.layouts.app')

@section('title', 'Add New Novel')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.novels.index') }}" 
               class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">Add Novel</h2>
                <p class="text-sm text-zinc-400">Create a new novel entry with detailed information.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm">
            <form action="{{ route('admin.novels.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                @csrf

                <!-- Basic Info Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i data-lucide="book-open" class="w-5 h-5 text-indigo-400"></i>
                        Basic Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 space-y-2">
                            <label for="title" class="block text-sm font-medium text-zinc-300">
                                Novel Title <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                                placeholder="Enter the main title"
                                class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-zinc-600 outline-none">
                            @error('title')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="author_id" class="block text-sm font-medium text-zinc-300">Author <span class="text-red-400">*</span></label>
                            <select name="author_id" id="author_id" required
                                class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                                <option value="" class="text-zinc-500">Select Author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-medium text-zinc-300">Status <span class="text-red-400">*</span></label>
                            <select name="status" id="status" required
                                class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published (Visible)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="h-px bg-zinc-800"></div>

                <!-- Classification Section -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i data-lucide="tags" class="w-5 h-5 text-indigo-400"></i>
                        Classification
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                         <div class="space-y-2">
                            <label for="genre_id" class="block text-sm font-medium text-zinc-300">Genre <span class="text-red-400">*</span></label>
                            <select name="genre_id" id="genre_id" required
                                class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                                <option value="">Select Genre</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="category_id" class="block text-sm font-medium text-zinc-300">Category <span class="text-red-400">*</span></label>
                            <select name="category_id" id="category_id" required
                                class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start gap-3 p-4 rounded-lg bg-zinc-950/50 border border-zinc-800">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-zinc-700 bg-zinc-900 text-indigo-600 focus:ring-indigo-500/50 focus:ring-offset-0 transition-all">
                                </div>
                                <div class="text-sm">
                                    <label for="is_featured" class="font-medium text-white cursor-pointer select-none">
                                        Feature on Home Slider
                                    </label>
                                    <p class="text-zinc-500 mt-0.5">Check this to display the novel in the main hero slider.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 rounded-lg bg-zinc-950/50 border border-zinc-800">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="is_premium" id="is_premium" value="1" {{ old('is_premium') ? 'checked' : '' }}
                                        class="w-4 h-4 rounded border-zinc-700 bg-zinc-900 text-amber-500 focus:ring-amber-500/50 focus:ring-offset-0 transition-all">
                                </div>
                                <div class="text-sm">
                                    <label for="is_premium" class="font-medium text-white cursor-pointer select-none">
                                        Premium Content
                                    </label>
                                    <p class="text-zinc-500 mt-0.5">Check this to mark this novel as Premium-only content.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-px bg-zinc-800"></div>

                <!-- Media & Synopsis -->
                <div class="space-y-6">
                    <h3 class="text-lg font-semibold text-white flex items-center gap-2">
                        <i data-lucide="image" class="w-5 h-5 text-indigo-400"></i>
                        Media & Content
                    </h3>

                    <div class="space-y-2">
                        <label for="description" class="block text-sm font-medium text-zinc-300">
                            Synopsis
                        </label>
                        <textarea name="description" id="description" rows="6"
                            placeholder="Write a compelling synopsis..."
                            class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-zinc-600 outline-none resize-none">{{ old('description') }}</textarea>
                    </div>

                    <div class="space-y-2">
                         <label for="cover_image" class="block text-sm font-medium text-zinc-300">
                            Cover Image
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-zinc-700 border-dashed rounded-lg hover:border-indigo-500/50 hover:bg-zinc-900/50 transition-all group cursor-pointer relative">
                             <input type="file" name="cover_image" id="cover_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="space-y-1 text-center">
                                <div class="mx-auto h-12 w-12 text-zinc-500 group-hover:text-indigo-400 transition-colors">
                                    <i data-lucide="image-plus" class="w-full h-full"></i>
                                </div>
                                <div class="flex text-sm text-zinc-400 justify-center">
                                    <span class="font-medium text-indigo-400 group-hover:underline">Upload a file</span>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-zinc-500">
                                    PNG, JPG, GIF up to 2MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="pt-6 border-t border-zinc-800 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.novels.index') }}"
                        class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Save Novel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection