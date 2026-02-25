<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Novel extends Model
{
    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'author_id',
        'genre_id',
        'category_id',
        'status',
        'is_featured',
        'is_premium',
        'total_views',
    ];

    /**
     * Get the author of the novel.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the genre of the novel.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Get the category of the novel.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the chapters of the novel.
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(NovelChapter::class)->orderBy('chapter_number');
    }

    /**
     * Get the reviews of the novel.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'item_id')->where('item_type', 'novel');
    }

    /**
     * Get the library items (bookmarks, readlist, history) for the novel.
     */
    public function libraryItems(): HasMany
    {
        return $this->hasMany(LibraryItem::class, 'item_id')->where('item_type', 'novel');
    }

    /**
     * Get the average rating.
     */
    public function getAverageRatingAttribute(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get the total chapters count.
     */
    public function getTotalChaptersAttribute(): int
    {
        return $this->chapters()->count();
    }

    /**
     * Scope for published novels.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for popular novels.
     */
    public function scopePopular($query)
    {
        return $query->orderBy('total_views', 'desc');
    }

    /**
     * Scope for most popular novels.
     */
    public function scopeMostPopular($query)
    {
        return $query->orderBy('total_views', 'desc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope for latest novels.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Scope for featured novels.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
