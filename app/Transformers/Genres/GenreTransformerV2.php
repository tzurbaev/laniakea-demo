<?php

declare(strict_types=1);

namespace App\Transformers\Genres;

use App\Interfaces\Genres\GenreTransformerInterface;
use App\Models\Genre;
use App\Transformers\Books\BookTransformer;
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

    public function includeBooks(Genre $genre): ResourceInterface
    {
        if (!$genre->relationLoaded('books')) {
            return $this->primitive([]);
        }

        return $this->collection($genre->books, new BookTransformer());
    }
}
