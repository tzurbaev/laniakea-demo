<?php

declare(strict_types=1);

namespace App\Repositories\Criteria\Books;

use Illuminate\Database\Eloquent\Builder;
use Laniakea\Repositories\Interfaces\RepositoryCriterionInterface;

readonly class BookItemCriterion implements RepositoryCriterionInterface
{
    public function __construct(private string $isbn)
    {
        //
    }

    public function apply(Builder $query): void
    {
        $query->where('isbn', $this->isbn);
    }
}
