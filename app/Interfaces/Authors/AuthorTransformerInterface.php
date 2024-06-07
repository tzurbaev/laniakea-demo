<?php

declare(strict_types=1);

namespace App\Interfaces\Authors;

use App\Models\Author;

interface AuthorTransformerInterface
{
    /**
     * Transform the author model.
     *
     * @param Author $author
     *
     * @return array
     */
    public function transform(Author $author): array;
}
