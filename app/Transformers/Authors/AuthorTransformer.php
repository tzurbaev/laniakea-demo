<?php

declare(strict_types=1);

namespace App\Transformers\Authors;

use App\Interfaces\Authors\AuthorTransformerInterface;
use App\Models\Author;
use App\Transformers\Books\BookTransformer;
use League\Fractal\TransformerAbstract;

class AuthorTransformer extends TransformerAbstract implements AuthorTransformerInterface
{
    protected array $availableIncludes = ['books'];

    public function transform(Author $author): array
    {
        return [
            'id' => $author->id,
            'name' => $author->name,
            'photo_url' => $author->photo_url,
            'bio' => $author->bio,
            'created_at' => $author->created_at->toIso8601String(),
            'updated_at' => $author->updated_at->toIso8601String(),
        ];
    }

    public function includeBooks(Author $author)
    {
        if (!$author->relationLoaded('books')) {
            return $this->primitive([]);
        }

        return $this->collection($author->books, new BookTransformer());
    }
}
