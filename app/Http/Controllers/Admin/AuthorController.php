<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index()
    {
        $authors = Author::withCount('novels')->latest()->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created author.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Author::create($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the author.
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the author.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($validated);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author berhasil diperbarui.');
    }

    /**
     * Remove the author.
     */
    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author berhasil dihapus.');
    }
}
