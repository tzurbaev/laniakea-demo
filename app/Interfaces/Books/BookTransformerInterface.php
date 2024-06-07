<?php

declare(strict_types=1);

namespace App\Interfaces\Books;

use App\Models\Book;

interface BookTransformerInterface
{
    public function transform(Book $book): array;
}
