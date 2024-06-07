<?php

declare(strict_types=1);

namespace App\Resources;

use App\Interfaces\Books\BooksGenreFilterInterface;
use App\Repositories\Criteria\Books\BookItemCriterion;
use App\Resources\Filters\BooksAuthorFilter;
use App\Resources\Filters\SearchFilter;
use Laniakea\Repositories\Interfaces\RepositoryCriterionInterface;
use Laniakea\Resources\Interfaces\HasItemCriterionInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;
use Laniakea\Resources\Interfaces\ResourceInterface;
use Laniakea\Resources\Interfaces\ResourceSorterInterface;
use Laniakea\Resources\Sorters\ColumnSorter;

class BooksResource implements ResourceInterface, HasItemCriterionInterface
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
        return new BookItemCriterion($id);
    }

    /**
     * Get available resource filters list.
     *
     * @return array<string, ResourceFilterInterface|string>
     */
    public function getFilters(): array
    {
        return [
            'search' => new SearchFilter(['isbn', 'title']),
            'author_id' => new BooksAuthorFilter(),

            // Genre filter depends on current API version,
            // so we're setting interface's class name instead of concrete implementation.
            // The `BooksResourceRegistrar` class registers the actual implementations for each API version.
            'genre_id' => BooksGenreFilterInterface::class,
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
            'author' => ['author'],
            'genre' => ['genre'],
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
            'title' => new ColumnSorter(),
            'created_at' => new ColumnSorter(),
            'updated_at' => new ColumnSorter(),
        ];
    }
}
