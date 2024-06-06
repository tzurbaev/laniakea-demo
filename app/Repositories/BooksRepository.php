<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Book;
use Laniakea\Repositories\AbstractRepository;

class BooksRepository extends AbstractRepository
{
    /**
     * Get model class name.
     *
     * @return string
     */
    protected function getModel(): string
    {
        return Book::class;
    }
}
