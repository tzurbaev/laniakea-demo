<?php

declare(strict_types=1);

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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

    public function getGenreId(): int
    {
        return $this->integer('genre_id');
    }

    public function getIsbn(): string
    {
        return $this->input('isbn');
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
