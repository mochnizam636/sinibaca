<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use App\Models\Novel;

class NovelController extends Controller
{
    /**
     * Display the novel detail page.
     */
    public function show(Novel $novel)
    {
        // Only show published novels (or allow if it's being viewed by admin)
        if ($novel->status !== 'published' && (!auth()->check() || !auth()->user()->isAdmin())) {
            abort(404);
        }

        $novel->load(['author', 'genre', 'category', 'chapters', 'reviews.user']);

        // Increment view count
        $novel->increment('total_views');

        // Check if user has bookmarked/readlisted this novel
        $isBookmarked = false;
        $isInReadlist = false;
        $readingHistory = null;

        if (auth()->check()) {
            $isBookmarked = LibraryItem::where('user_id', auth()->id())
                ->where('item_type', 'novel')
                ->where('item_id', $novel->id)
                ->where('status', 'bookmark')
                ->exists();

            $isInReadlist = LibraryItem::where('user_id', auth()->id())
                ->where('item_type', 'novel')
                ->where('item_id', $novel->id)
                ->where('status', 'readlist')
                ->exists();

            $readingHistory = LibraryItem::where('user_id', auth()->id())
                ->where('item_type', 'novel')
                ->where('item_id', $novel->id)
                ->where('status', 'history')
                ->with('chapter')
                ->first();
        }

        $lastReadChapterNumber = $readingHistory ? $readingHistory->chapter->chapter_number : 0;

        return view('novels.show', compact('novel', 'isBookmarked', 'isInReadlist', 'readingHistory', 'lastReadChapterNumber'));
    }
}
