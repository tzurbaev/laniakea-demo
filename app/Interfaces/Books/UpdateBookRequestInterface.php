<?php

declare(strict_types=1);

namespace App\Interfaces\Books;

use App\Models\Book;

interface UpdateBookRequestInterface extends StoreBookRequestInterface
{
    /**
     * Get current book.
     *
     * @return Book
     */
    public function getBook(): Book;
}
