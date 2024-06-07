<?php

declare(strict_types=1);

namespace App\Transformers\Books;

use App\Interfaces\Authors\AuthorTransformerInterface;
use App\Interfaces\Books\BookTransformerInterface;
use App\Interfaces\Genres\GenreTransformerInterface;
use App\Models\Book;
use Illuminate\Support\Str;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

abstract class AbstractBookTransformer extends TransformerAbstract implements BookTransformerInterface
{
    protected array $availableIncludes = ['author', 'genre'];

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

        return $this->item($book->author, app(AuthorTransformerInterface::class));
    }

    public function includeGenre(Book $book): ResourceInterface
    {
        if (!$book->relationLoaded('genre')) {
            return $this->primitive(null);
        }

        return $this->item($book->genre, app(GenreTransformerInterface::class));
    }
}
