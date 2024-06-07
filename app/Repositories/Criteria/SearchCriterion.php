<?php

declare(strict_types=1);

namespace App\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Laniakea\Repositories\Interfaces\RepositoryCriterionInterface;

readonly class SearchCriterion implements RepositoryCriterionInterface
{
    /**
     * @param array<string> $columns List of columns to search in.
     * @param string        $query   Search query.
     */
    public function __construct(private array $columns, private string $query)
    {
        //
    }

    /**
     * Apply the search criterion.
     * This will add `where ... like` statements to the query.
     *
     * @param Builder $query
     */
    public function apply(Builder $query): void
    {
        $query->where(function (Builder $subQuery) {
            foreach ($this->columns as $column) {
                $subQuery->orWhere($column, 'like',  '%'.$this->query.'%');
            }
        });
    }
}
