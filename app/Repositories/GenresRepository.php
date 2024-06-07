<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Genre;
use Laniakea\Repositories\AbstractRepository;
use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;

class GenresRepository extends AbstractRepository
{
    /**
     * Get model class name.
     *
     * @return string
     */
    protected function getModel(): string
    {
        return Genre::class;
    }

    /**
     * Get list of genres as options for select field.
     *
     * @return array
     */
    public function getOptionsList(): array
    {
        // List of genres ordered by name and transformed into ['id', 'name'] arrays.
        $authors = $this->list(fn (RepositoryQueryBuilderInterface $query) => $query->orderBy('name'))
            ->map(fn (Genre $genre) => [
                'id' => $genre->id,
                'name' => $genre->name,
            ]);

        // Prepend the list with a default empty option.
        return $authors->prepend(['id' => null, 'name' => '– Select Genre –'])->toArray();
    }
}
