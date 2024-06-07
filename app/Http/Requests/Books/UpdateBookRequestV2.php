<?php

declare(strict_types=1);

namespace App\Http\Requests\Books;

use App\Interfaces\Books\UpdateBookRequestInterface;
use App\Models\Book;

class UpdateBookRequestV2 extends StoreBookRequestV2 implements UpdateBookRequestInterface
{
    public function getBook(): Book
    {
        return $this->route('book');
    }
}
