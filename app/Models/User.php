<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the user's active subscription.
     */
    public function subscription(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->where('expires_at', '>', now())->latest();
    }

    /**
     * Check if user is premium.
     */
    public function isPremium(): bool
    {
        return $this->subscription()->exists();
    }

    /**
     * Get the library items for the user.
     */
    public function libraryItems(): HasMany
    {
        return $this->hasMany(LibraryItem::class);
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get user's bookmarks.
     */
    public function bookmarks(): HasMany
    {
        return $this->libraryItems()->where('status', 'bookmark');
    }

    /**
     * Get user's readlist.
     */
    public function readlist(): HasMany
    {
        return $this->libraryItems()->where('status', 'readlist');
    }

    /**
     * Get user's reading history.
     */
    public function readingHistory(): HasMany
    {
        return $this->libraryItems()->where('status', 'history')->orderBy('updated_at', 'desc');
    }
}
