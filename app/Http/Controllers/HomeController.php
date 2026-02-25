<?php

namespace App\Http\Controllers;

use App\Models\Novel;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Get Most Popular novels for "Most Popular" section (replacing Editor's Choice as requested)
        $recommended = Novel::published()
            ->with(['author', 'genre'])
            ->popular() // Scoped by total_views
            ->take(6)
            ->get();

        // Get latest updated novels
        $latestUpdates = Novel::published()
            ->with(['author', 'genre'])
            ->latest()
            ->take(8)
            ->get();

        // Get popular novels (by total views)
        $popular = Novel::published()
            ->with(['author', 'genre'])
            ->popular()
            ->take(8)
            ->get();

        // Get user's latest reading history if logged in
        $continueReading = null;
        if (auth()->check()) {
            $continueReading = \App\Models\LibraryItem::where('user_id', auth()->id())
                ->where('item_type', 'novel')
                ->where('status', 'history')
                ->with(['novel', 'chapter'])
                ->latest()
                ->take(4)
                ->get();
        } else {
            $continueReading = collect();
        }

        return view('home', compact('recommended', 'latestUpdates', 'popular', 'continueReading'));
    }
}
