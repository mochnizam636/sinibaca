<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Novel;
use App\Models\NovelChapter;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_novels' => Novel::count(),
            'total_chapters' => NovelChapter::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_authors' => Author::count(),
            'total_genres' => Genre::count(),
            'total_categories' => Category::count(),
            'published_novels' => Novel::where('status', 'published')->count(),
            'draft_novels' => Novel::where('status', 'draft')->count(),
        ];

        $latestNovels = Novel::with('author')->latest()->take(5)->get();
        $latestUsers = User::where('role', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestNovels', 'latestUsers'));
    }
}
