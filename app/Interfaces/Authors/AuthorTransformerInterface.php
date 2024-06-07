<?php

declare(strict_types=1);

namespace App\Interfaces\Authors;

use App\Models\Author;

interface AuthorTransformerInterface
{
    public function transform(Author $author): array;
}
