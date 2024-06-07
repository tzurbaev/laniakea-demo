<?php

declare(strict_types=1);

namespace App\Http\Requests\Books;

use App\Enums\GenreIdType;
use App\Interfaces\Books\StoreBookRequestInterface;
use App\Settings\BookSetting;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequestV2 extends FormRequest implements StoreBookRequestInterface
{
    public function rules(): array
    {
        return [
            'author_id' => 'required|integer|exists:authors,id',
            'genre_id' => 'required|string|exists:genres,slug',
            'isbn' => 'required|string|max:255',
            'release_year' => 'required|integer',
            'title' => 'required|string|max:255',
            'cover_url' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'settings' => 'required|array',
            'settings.full_synopsis' => 'required|boolean',
            'settings.synopsis_length' => 'nullable|integer',
        ];
    }

    public function getAuthorId(): int
    {
        return $this->integer('author_id');
    }

    public function getGenreIdType(): GenreIdType
    {
        // API v2 expects `genre_id` to be a slug, so we return `SLUG` case here.
        return GenreIdType::SLUG;
    }

    public function getGenreId(): string
    {
        return $this->input('genre_id');
    }

    public function getIsbn(): string
    {
        return $this->input('isbn');
    }

    public function getReleaseYear(): ?int
    {
        return $this->integer('release_year');
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getCoverUrl(): string
    {
        return $this->input('cover_url');
    }

    public function getSynopsis(): ?string
    {
        return $this->input('synopsis');
    }

    public function getSettings(): array
    {
        return [
            BookSetting::SHOW_FULL_SYNOPSIS->value => $this->boolean('settings.full_synopsis', true),
            BookSetting::SYNOPSIS_LENGTH->value => $this->integer('settings.synopsis_length'),
        ];
    }
}
