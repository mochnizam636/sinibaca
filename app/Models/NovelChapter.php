<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NovelChapter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'novel_id',
        'title',
        'content',
        'chapter_number',
        'is_premium',
        'views',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'created_at' => 'datetime',
    ];

    /**
     * Get the novel that owns the chapter.
     */
    public function novel(): BelongsTo
    {
        return $this->belongsTo(Novel::class);
    }

    /**
     * Get the previous chapter.
     */
    public function getPreviousChapterAttribute(): ?NovelChapter
    {
        return NovelChapter::where('novel_id', $this->novel_id)
            ->where('chapter_number', '<', $this->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();
    }

    /**
     * Get the next chapter.
     */
    public function getNextChapterAttribute(): ?NovelChapter
    {
        return NovelChapter::where('novel_id', $this->novel_id)
            ->where('chapter_number', '>', $this->chapter_number)
            ->orderBy('chapter_number', 'asc')
            ->first();
    }
}
