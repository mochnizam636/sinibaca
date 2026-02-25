<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Novel;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Display the explore/browse page.
     */
    public function index(Request $request)
    {
        $query = Novel::published()->with(['author', 'genre', 'category']);

        // Filter by genre
        if ($request->filled('genre')) {
            $query->where('genre_id', $request->genre);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search by title or author
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('author', function ($aq) use ($search) {
                        $aq->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        // Sort options
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'popular':
                $query->orderBy('total_views', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
        }

        $novels = $query->paginate(12)->withQueryString();
        $genres = Genre::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('explore', compact('novels', 'genres', 'categories'));
    }
}
