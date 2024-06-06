<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Author;
use Laniakea\Repositories\AbstractRepository;

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
}
