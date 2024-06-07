<?php

declare(strict_types=1);

namespace App\Interfaces\Genres;

use App\Models\Genre;

interface GenreTransformerInterface
{
    /**
     * Transform the genre model.
     *
     * @param Genre $genre
     *
     * @return array
     */
    public function transform(Genre $genre): array;
}
