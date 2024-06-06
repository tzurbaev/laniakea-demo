<?php

declare(strict_types=1);

namespace App\Resources;

use App\Resources\Filters\BooksAuthorFilter;
use App\Resources\Filters\BooksGenreFilter;
use App\Resources\Filters\SearchFilter;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;
use Laniakea\Resources\Interfaces\ResourceInterface;
use Laniakea\Resources\Interfaces\ResourceSorterInterface;
use Laniakea\Resources\Sorters\ColumnSorter;

class BooksResource implements ResourceInterface
{
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
            'genre_id' => new BooksGenreFilter(),
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
