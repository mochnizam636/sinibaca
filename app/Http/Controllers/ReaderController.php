<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use App\Models\Novel;
use App\Models\NovelChapter;

class ReaderController extends Controller
{
    /**
     * Display the chapter reading page.
     */
    public function show(Novel $novel, NovelChapter $chapter)
    {
        // Check if novel is published
        if ($novel->status !== 'published' && (!auth()->check() || !auth()->user()->isAdmin())) {
            abort(404);
        }

        // Increment chapter view count
        $chapter->increment('views');

        // Save reading history for logged-in users
        if (auth()->check()) {
            LibraryItem::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'item_type' => 'novel',
                    'item_id' => $novel->id,
                    'status' => 'history',
                ],
                [
                    'progress' => $chapter->id,
                    'updated_at' => now(),
                ]
            );
        }

        // Get previous and next chapters
        $previousChapter = $chapter->previousChapter;
        $nextChapter = $chapter->nextChapter;

        return view('reader.show', compact('novel', 'chapter', 'previousChapter', 'nextChapter'));
    }
}
