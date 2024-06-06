<?php

declare(strict_types=1);

namespace App\Resources;

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
        return [];
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
