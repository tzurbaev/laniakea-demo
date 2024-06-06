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

    public function apply(Builder $query): void
    {
        $query->where('slug', $this->slug);
    }
}
