<?php

declare(strict_types=1);

namespace App\Resources\Filters;

use Laniakea\Repositories\Criteria\ExactValueCriterion;
use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;

class BooksGenreFilter implements ResourceFilterInterface
{
    public function apply(RepositoryQueryBuilderInterface $query, mixed $value, array $values): void
    {
        if (!is_numeric($value)) {
            return;
        }

        // Use built-in criterion to apply filter.
        $query->addCriteria([
            new ExactValueCriterion('genre_id', intval($value)),
        ]);
    }
}
