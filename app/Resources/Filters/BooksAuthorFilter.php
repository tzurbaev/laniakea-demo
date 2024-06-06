<?php

declare(strict_types=1);

namespace App\Resources\Filters;

use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;

class BooksAuthorFilter implements ResourceFilterInterface
{
    public function apply(RepositoryQueryBuilderInterface $query, mixed $value, array $values): void
    {
        if (!is_numeric($value)) {
            return;
        }

        // Apply filter directly to the query builder (without criterion).
        $query->getQueryBuilder()->where('author_id', intval($value));
    }
}
