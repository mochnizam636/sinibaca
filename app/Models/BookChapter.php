<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * BookChapter Model
 * Note: This model is kept but not actively used in the application.
 */
class BookChapter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'book_id',
        'title',
        'content',
        'chapter_number',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Get the book that owns the chapter.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
