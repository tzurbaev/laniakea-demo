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

    /**
     * This custom criterion is used by BooksResource, so we can use book's ISBN as route key instead of integer ID.
     *
     * @param Builder $query
     */
    public function apply(Builder $query): void
    {
        $query->where('isbn', $this->isbn);
    }
}
