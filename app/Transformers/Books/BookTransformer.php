<?php

declare(strict_types=1);

namespace App\Transformers\Books;

use App\Models\Book;
use App\Transformers\Authors\AuthorTransformer;
use App\Transformers\Genres\GenreTransformer;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['author', 'genre'];

    public function transform(Book $book): array
    {
        return [
            'id' => $book->id,
            'isbn' => $book->isbn,
            'title' => $book->title,
            'cover_url' => $book->cover_url,
            'synopsis' => $book->synopsis,
            'created_at' => $book->created_at->toIso8601String(),
            'updated_at' => $book->updated_at->toIso8601String(),
        ];
    }

    public function includeAuthor(Book $book): ResourceInterface
    {
        if (!$book->relationLoaded('author')) {
            return $this->primitive(null);
        }

        return $this->item($book->author, new AuthorTransformer());
    }

    public function includeGenre(Book $book): ResourceInterface
    {
        if (!$book->relationLoaded('genre')) {
            return $this->primitive(null);
        }

        return $this->item($book->genre, new GenreTransformer());
    }
}
