<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a new review for a novel.
     */
    public function store(Request $request, Novel $novel)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        // Check if user already reviewed this novel
        $existingReview = Review::where('user_id', auth()->id())
            ->where('item_type', 'novel')
            ->where('item_id', $novel->id)
            ->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);
            $message = 'Review Anda telah diperbarui.';
        } else {
            Review::create([
                'user_id' => auth()->id(),
                'item_type' => 'novel',
                'item_id' => $novel->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);
            $message = 'Terima kasih atas review Anda!';
        }

        return back()->with('success', $message);
    }

    /**
     * Remove the review.
     */
    public function destroy(Review $review)
    {
        if (auth()->id() !== $review->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review telah dihapus.');
    }
}
