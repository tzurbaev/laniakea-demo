<?php

declare(strict_types=1);

namespace App\Transformers\Genres;

use App\Interfaces\Books\BookTransformerInterface;
use App\Interfaces\Genres\GenreTransformerInterface;
use App\Models\Genre;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

class GenreTransformerV2 extends TransformerAbstract implements GenreTransformerInterface
{
    protected array $availableIncludes = ['books'];

    public function transform(Genre $genre): array
    {
        return [
            'id' => $genre->slug,
            'name' => $genre->name,
        ];
    }

    /**
     * Handle `books` inclusion.
     *
     * @param Genre $genre
     *
     * @return ResourceInterface
     */
    public function includeBooks(Genre $genre): ResourceInterface
    {
        if (!$genre->relationLoaded('books')) {
            return $this->primitive([]);
        }

        return $this->collection($genre->books, app(BookTransformerInterface::class));
    }
}
