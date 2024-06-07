<?php

namespace App\Models;

use App\Settings\BookSetting;
use App\Settings\BookSettingsDecorator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laniakea\Settings\Concerns\CreatesSettingsDecorators;
use Laniakea\Settings\Interfaces\HasSettingsDecoratorInterface;
use Laniakea\Settings\Interfaces\HasSettingsInterface;

class Book extends Model implements HasSettingsInterface, HasSettingsDecoratorInterface
{
    use HasFactory;
    use CreatesSettingsDecorators;

    protected $fillable = [
        'author_id', 'genre_id', 'isbn', 'title',
        'synopsis', 'cover_url', 'settings',
    ];

    protected $casts = [
        'author_id' => 'integer',
        'genre_id' => 'integer',
        'settings' => 'array',
    ];

    public function getSettingsDecorator(bool $fresh = false): BookSettingsDecorator
    {
        return $this->makeSettingsDecorator(BookSettingsDecorator::class, $fresh);
    }

    public function getSettingsEnum(): string
    {
        return BookSetting::class;
    }

    public function getCurrentSettings(): ?array
    {
        return $this->settings;
    }

    public function updateSettings(array $settings): void
    {
        $this->update(['settings' => $settings]);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
