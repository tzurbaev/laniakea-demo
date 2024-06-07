<?php

declare(strict_types=1);

namespace App\Http\Requests\Books;

use App\Enums\GenreIdType;
use App\Interfaces\Books\StoreBookRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest implements StoreBookRequestInterface
{
    public function rules(): array
    {
        return [
            'author_id' => 'required|integer|exists:authors,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'isbn' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'cover_url' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
        ];
    }

    public function getAuthorId(): int
    {
        return $this->integer('author_id');
    }

    public function getGenreIdType(): GenreIdType
    {
        // API v1 expects `genre_id` to be an integer, so we return `ID` case here.
        return GenreIdType::ID;
    }

    public function getGenreId(): int
    {
        return $this->integer('genre_id');
    }

    public function getIsbn(): string
    {
        return $this->input('isbn');
    }

    public function getReleaseYear(): ?int
    {
        // API v1 does not have a release year field, so we return null;

        return null;
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
            'show_full_synopsis' => $this->boolean('show_full_synopsis'),
            'synopsis_length' => $this->integer('synopsis_length'),
        ];
    }
}
