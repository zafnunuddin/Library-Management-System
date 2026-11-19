<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegalPage extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'version',
        'updated_by',
    ];

    /**
     * Well-known slugs used across the app (login page, register page, footer links, etc).
     */
    public const TERMS = 'terms';
    public const PRIVACY = 'privacy-policy';

    /**
     * The admin who last saved this page.
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Fetch a page by its slug, or null if it hasn't been created yet.
     */
    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }
}
