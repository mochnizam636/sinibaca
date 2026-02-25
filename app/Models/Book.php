<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Book Model
 * Note: This model is kept but not actively used in the application.
 * The focus is on novels.
 */
class Book extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'author_id',
        'genre_id',
        'category_id',
        'page_count',
        'total_views',
        'content_long',
    ];

    /**
     * Get the author of the book.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the genre of the book.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Get the category of the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the chapters of the book.
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(BookChapter::class)->orderBy('chapter_number');
    }
}
