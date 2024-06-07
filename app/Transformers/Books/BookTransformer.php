<?php

declare(strict_types=1);

namespace App\Transformers\Books;

use App\Interfaces\Genres\GenreTransformerInterface;
use App\Models\Book;
use App\Transformers\Authors\AuthorTransformer;
use Illuminate\Support\Str;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['author', 'genre'];

    public function transform(Book $book): array
    {
        return [
            'id' => $book->id,
            'isbn' => $book->isbn,
            'title' => $book->title,
            'cover_url' => $book->cover_url,
            'synopsis' => $this->getSynopsis($book),
            'created_at' => $book->created_at->toIso8601String(),
            'updated_at' => $book->updated_at->toIso8601String(),
        ];
    }

    /**
     * Get synopsis based on settings.
     *
     * @param Book $book
     *
     * @return string
     */
    protected function getSynopsis(Book $book): string
    {
        if ($book->getSettingsDecorator()->showFullSynopsis()) {
            return $book->synopsis;
        }

        return Str::limit($book->synopsis, $book->getSettingsDecorator()->getSynopsisLength());
    }

    public function includeAuthor(Book $book): ResourceInterface
    {
        if (!$book->relationLoaded('author')) {
            return $this->primitive(null);
        }

        return $this->item($book->author, new AuthorTransformer());
    }

    public function includeGenre(Book $book): ResourceInterface
    {
        if (!$book->relationLoaded('genre')) {
            return $this->primitive(null);
        }

        return $this->item($book->genre, app(GenreTransformerInterface::class));
    }
}
