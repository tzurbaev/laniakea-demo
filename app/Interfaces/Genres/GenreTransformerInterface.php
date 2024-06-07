<?php

declare(strict_types=1);

namespace App\Interfaces\Genres;

use App\Models\Genre;

interface GenreTransformerInterface
{
    public function transform(Genre $genre): array;
}
