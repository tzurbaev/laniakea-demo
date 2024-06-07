<?php

declare(strict_types=1);

namespace App\Repositories\Criteria\Genres;

use Illuminate\Database\Eloquent\Builder;
use Laniakea\Repositories\Interfaces\RepositoryCriterionInterface;

readonly class GenreItemCriterion implements RepositoryCriterionInterface
{
    public function __construct(private string $slug)
    {
        //
    }

    /**
     * This custom criterion is used by GenresResource, so we can use genre's slug as route key instead of integer ID.
     *
     * @param Builder $query
     */
    public function apply(Builder $query): void
    {
        $query->where('slug', $this->slug);
    }
}
