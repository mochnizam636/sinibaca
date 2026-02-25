@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="max-w-xl mx-auto">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.categories.index') }}"
                class="p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-zinc-800 transition-colors">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-white">Edit Category</h2>
                <p class="text-sm text-zinc-400">Update category details.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden shadow-sm">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-zinc-300">
                        Category Name <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required
                        class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-zinc-600 outline-none">
                    @error('name')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="description" class="block text-sm font-medium text-zinc-300">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full bg-zinc-950 border border-zinc-700 text-white rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-zinc-600 outline-none resize-none">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-4 py-2 text-sm font-medium text-zinc-400 hover:text-white hover:bg-zinc-800 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg shadow-lg shadow-indigo-600/20 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection