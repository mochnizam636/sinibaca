<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Get the novels for the genre.
     */
    public function novels(): HasMany
    {
        return $this->hasMany(Novel::class);
    }

    /**
     * Get the books for the genre.
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
