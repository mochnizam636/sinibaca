<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Novel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NovelController extends Controller
{
    /**
     * Display a listing of the novels.
     */
    public function index()
    {
        $novels = Novel::with(['author', 'genre', 'category'])
            ->withCount('chapters')
            ->latest()
            ->paginate(10);

        return view('admin.novels.index', compact('novels'));
    }

    /**
     * Show the form for creating a new novel.
     */
    public function create()
    {
        $authors = Author::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.novels.create', compact('authors', 'genres', 'categories'));
    }

    /**
     * Store a newly created novel.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'is_featured' => 'sometimes|boolean',
            'is_premium' => 'sometimes|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_premium'] = $request->boolean('is_premium');

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $path;
        }

        Novel::create($validated);

        return redirect()->route('admin.novels.index')
            ->with('success', 'Novel berhasil ditambahkan.');
    }

    /**
     * Display the novel details.
     */
    public function show(Novel $novel)
    {
        $novel->load(['author', 'genre', 'category', 'chapters']);
        return view('admin.novels.show', compact('novel'));
    }

    /**
     * Show the form for editing the novel.
     */
    public function edit(Novel $novel)
    {
        $authors = Author::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.novels.edit', compact('novel', 'authors', 'genres', 'categories'));
    }

    /**
     * Update the novel.
     */
    public function update(Request $request, Novel $novel)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'author_id' => 'required|exists:authors,id',
            'genre_id' => 'required|exists:genres,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published',
            'is_featured' => 'sometimes|boolean',
            'is_premium' => 'sometimes|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_premium'] = $request->boolean('is_premium');

        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($novel->cover_image) {
                Storage::disk('public')->delete($novel->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $validated['cover_image'] = $path;
        }

        $novel->update($validated);

        return redirect()->route('admin.novels.index')
            ->with('success', 'Novel berhasil diperbarui.');
    }

    /**
     * Remove the novel.
     */
    public function destroy(Novel $novel)
    {
        // Delete cover image
        if ($novel->cover_image) {
            Storage::disk('public')->delete($novel->cover_image);
        }

        $novel->delete();

        return redirect()->route('admin.novels.index')
            ->with('success', 'Novel berhasil dihapus.');
    }
}
