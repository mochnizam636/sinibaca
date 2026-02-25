<?php

namespace App\Http\Controllers;

use App\Models\LibraryItem;
use App\Models\Novel;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display the user's library.
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'history');

        $bookmarks = auth()->user()->bookmarks()
            ->where('item_type', 'novel')
            ->with(['novel.author', 'novel.genre'])
            ->latest()
            ->get();

        $readlist = auth()->user()->readlist()
            ->where('item_type', 'novel')
            ->with(['novel.author', 'novel.genre'])
            ->latest()
            ->get();

        $history = auth()->user()->readingHistory()
            ->where('item_type', 'novel')
            ->with(['novel.author', 'novel.genre', 'chapter'])
            ->get();

        return view('library.index', compact('bookmarks', 'readlist', 'history', 'tab'));
    }

    /**
     * Add novel to bookmarks.
     */
    public function addBookmark(Novel $novel)
    {
        LibraryItem::firstOrCreate([
            'user_id' => auth()->id(),
            'item_type' => 'novel',
            'item_id' => $novel->id,
            'status' => 'bookmark',
        ]);

        return back()->with('success', 'Novel ditambahkan ke bookmark.');
    }

    /**
     * Remove novel from bookmarks.
     */
    public function removeBookmark(Novel $novel)
    {
        LibraryItem::where('user_id', auth()->id())
            ->where('item_type', 'novel')
            ->where('item_id', $novel->id)
            ->where('status', 'bookmark')
            ->delete();

        return back()->with('success', 'Novel dihapus dari bookmark.');
    }

    /**
     * Add novel to readlist.
     */
    public function addReadlist(Novel $novel)
    {
        LibraryItem::firstOrCreate([
            'user_id' => auth()->id(),
            'item_type' => 'novel',
            'item_id' => $novel->id,
            'status' => 'readlist',
        ]);

        return back()->with('success', 'Novel ditambahkan ke readlist.');
    }

    /**
     * Remove novel from readlist.
     */
    public function removeReadlist(Novel $novel)
    {
        LibraryItem::where('user_id', auth()->id())
            ->where('item_type', 'novel')
            ->where('item_id', $novel->id)
            ->where('status', 'readlist')
            ->delete();

        return back()->with('success', 'Novel dihapus dari readlist.');
    }

    /**
     * Remove novel from history.
     */
    public function removeHistory(Novel $novel)
    {
        LibraryItem::where('user_id', auth()->id())
            ->where('item_type', 'novel')
            ->where('item_id', $novel->id)
            ->where('status', 'history')
            ->delete();

        return back()->with('success', 'Novel dihapus dari history.');
    }
}
