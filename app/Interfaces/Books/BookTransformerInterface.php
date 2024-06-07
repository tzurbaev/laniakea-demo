<?php

declare(strict_types=1);

namespace App\Interfaces\Books;

use App\Models\Book;

interface BookTransformerInterface
{
    /**
     * Transform the book model.
     *
     * @param Book $book
     *
     * @return array
     */
    public function transform(Book $book): array;
}
