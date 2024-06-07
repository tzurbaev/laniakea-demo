<?php

declare(strict_types=1);

namespace App\Transformers\Books;

use App\Models\Book;

class BookTransformerV2 extends AbstractBookTransformer
{
    public function transform(Book $book): array
    {
        return [
            'id' => $book->isbn,
            'title' => $book->title,
            'release_year' => $book->release_year?->year,
            'cover_url' => $book->cover_url,
            'synopsis' => $this->getSynopsis($book),
        ];
    }
}
