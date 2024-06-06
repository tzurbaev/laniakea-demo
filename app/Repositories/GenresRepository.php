<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Genre;
use Laniakea\Repositories\AbstractRepository;

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
}
