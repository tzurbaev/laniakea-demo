<?php

declare(strict_types=1);

namespace App\Transformers\Genres;

use App\Models\Genre;
use App\Transformers\Books\BookTransformer;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

class GenreTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['books'];

    public function transform(Genre $genre): array
    {
        return [
            'id' => $genre->id,
            'name' => $genre->name,
            'created_at' => $genre->created_at->toIso8601String(),
            'updated_at' => $genre->updated_at->toIso8601String(),
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
