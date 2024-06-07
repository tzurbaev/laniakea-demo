<?php

declare(strict_types=1);

namespace App\Transformers\Authors;

use App\Interfaces\Authors\AuthorTransformerInterface;
use App\Interfaces\Books\BookTransformerInterface;
use App\Models\Author;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

class AuthorTransformerV2 extends TransformerAbstract implements AuthorTransformerInterface
{
    protected array $availableIncludes = ['books'];

    public function transform(Author $author): array
    {
        return [
            'id' => $author->id,
            'full_name' => $author->name,
            'country' => $author->country,
            'biography' => $author->bio,
            'photo_url' => $author->photo_url,
        ];
    }

    /**
     * Handle `books` inclusion.
     *
     * @param Author $author
     *
     * @return ResourceInterface
     */
    public function includeBooks(Author $author): ResourceInterface
    {
        if (!$author->relationLoaded('books')) {
            return $this->primitive([]);
        }

        return $this->collection($author->books, app(BookTransformerInterface::class));
    }
}
