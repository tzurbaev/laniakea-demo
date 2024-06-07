<?php

declare(strict_types=1);

namespace App\Resources\Filters;

use App\Repositories\Criteria\SearchCriterion;
use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;

readonly class SearchFilter implements ResourceFilterInterface
{
    /**
     * @param array<string> $columns List of columns to search in.
     */
    public function __construct(private array $columns)
    {
        //
    }

    /**
     * This intermediate filter is used to push search criterion to the query.
     *
     * @param RepositoryQueryBuilderInterface $query
     * @param mixed                           $value
     * @param array                           $values
     */
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
