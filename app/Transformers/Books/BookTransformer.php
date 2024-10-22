<?php

declare(strict_types=1);

namespace App\Transformers\Books;

use App\Models\Book;

class BookTransformer extends AbstractBookTransformer
{
    public function transform(Book $book): array
    {
        return [
            'id' => $book->id,
            'isbn' => $book->isbn,
            'title' => $book->title,
            'cover_url' => $book->cover_url,
            'synopsis' => $this->getSynopsis($book),
            'created_at' => $book->created_at->toIso8601String(),
            'updated_at' => $book->updated_at->toIso8601String(),
        ];
    }
}
