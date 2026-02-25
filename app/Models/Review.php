<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'item_type',
        'item_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that wrote the review.
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
     * Scope for novel reviews.
     */
    public function scopeForNovels($query)
    {
        return $query->where('item_type', 'novel');
    }
}
