<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Author;
use Laniakea\Repositories\AbstractRepository;
use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;

class AuthorsRepository extends AbstractRepository
{
    /**
     * Get model class name.
     *
     * @return string
     */
    protected function getModel(): string
    {
        return Author::class;
    }

    /**
     * Get list of authors as options for select field.
     *
     * @return array
     */
    public function getOptionsList(): array
    {
        // List of authors ordered by name and transformed into ['id', 'name'] arrays.
        $authors = $this->list(fn (RepositoryQueryBuilderInterface $query) => $query->orderBy('name'))
            ->map(fn (Author $author) => [
                'id' => $author->id,
                'name' => $author->name,
            ]);

        // Prepend the list with a default empty option.
        return $authors->prepend(['id' => null, 'name' => '– Select Author –'])->toArray();
    }
}
