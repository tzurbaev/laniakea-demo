<?php

declare(strict_types=1);

namespace App\Resources;

use App\Repositories\Criteria\Genres\GenreItemCriterion;
use App\Resources\Filters\SearchFilter;
use Laniakea\Repositories\Interfaces\RepositoryCriterionInterface;
use Laniakea\Resources\Interfaces\HasItemCriterionInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;
use Laniakea\Resources\Interfaces\ResourceInterface;
use Laniakea\Resources\Interfaces\ResourceSorterInterface;
use Laniakea\Resources\Sorters\ColumnSorter;

class GenresResource implements ResourceInterface, HasItemCriterionInterface
{
    /**
     * Get custom item criterion for the current resource.
     *
     * @param mixed $id
     *
     * @return RepositoryCriterionInterface
     */
    public function getItemCriterion(mixed $id): RepositoryCriterionInterface
    {
        return new GenreItemCriterion($id);
    }

    /**
     * Get available resource filters list.
     *
     * @return array<string, ResourceFilterInterface|string>
     */
    public function getFilters(): array
    {
        return [
            'search' => new SearchFilter(['name']),
        ];
    }

    /**
     * Get available inclusions list.
     *
     * @return array<string, string[]>
     */
    public function getInclusions(): array
    {
        return [
            'books' => ['books'],
        ];
    }

    /**
     * Get available sorters list.
     *
     * @return array<string, ResourceSorterInterface>
     */
    public function getSorters(): array
    {
        return [
            'id' => new ColumnSorter(),
            'name' => new ColumnSorter(),
            'created_at' => new ColumnSorter(),
            'updated_at' => new ColumnSorter(),
        ];
    }
}
