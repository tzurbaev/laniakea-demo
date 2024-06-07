<?php

declare(strict_types=1);

namespace App\Http\Requests\Books;

use App\Models\Book;

class UpdateBookRequest extends StoreBookRequest
{
    public function getBook(): Book
    {
        return $this->route('book');
    }
}
