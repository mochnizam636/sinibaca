<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryItem extends Model
{
    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'status',
        'progress',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the library item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the novel if item_type is 'novel'.
     */
    public function novel(): BelongsTo
    {
        return $this->belongsTo(Novel::class, 'item_id');
    }

    /**
     * Get the chapter for reading progress.
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(NovelChapter::class, 'progress');
    }

    /**
     * Scope for bookmarks.
     */
    public function scopeBookmarks($query)
    {
        return $query->where('status', 'bookmark');
    }

    /**
     * Scope for readlist.
     */
    public function scopeReadlist($query)
    {
        return $query->where('status', 'readlist');
    }

    /**
     * Scope for history.
     */
    public function scopeHistory($query)
    {
        return $query->where('status', 'history');
    }

    /**
     * Scope for novels only.
     */
    public function scopeNovels($query)
    {
        return $query->where('item_type', 'novel');
    }
}
