<?php

declare(strict_types=1);

namespace App\Resources\Filters;

use App\Repositories\Criteria\SearchCriterion;
use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;

readonly class SearchFilter implements ResourceFilterInterface
{
    public function __construct(private array $columns)
    {
        //
    }

    public function apply(RepositoryQueryBuilderInterface $query, mixed $value, array $values): void
    {
        if (empty($value)) {
            return;
        }

        $query->addCriteria([
            new SearchCriterion($this->columns, $value),
        ]);
    }
}
