<?php

declare(strict_types=1);

namespace App\Forms;

use App\Models\Book;

class EditBookForm extends CreateBookForm
{
    /**
     * @param Book $book Book to be edited.
     */
    public function __construct(private readonly Book $book, array $authors, array $genres)
    {
        parent::__construct($authors, $genres);
    }

    /**
     * HTTP method that will be used to submit the form.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return 'PUT';
    }

    /**
     * Form submission URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return route('api.v1.books.update', [
            'book' => $this->book->isbn, // Books are identified by ISBN, not by ID.
        ]);
    }

    /**
     * Form values.
     *
     * @return array
     */
    public function getValues(): array
    {
        return [
            'author_id' => $this->book->author_id,
            'genre_id' => $this->book->genre_id,
            'isbn' => $this->book->isbn,
            'title' => $this->book->title,
            'cover_url' => $this->book->cover_url,
            'synopsis' => $this->book->synopsis,
            'show_full_synopsis' => $this->book->getSettingsDecorator()->showFullSynopsis(),
            'synopsis_length' => $this->book->getSettingsDecorator()->getSynopsisLength() ?? '',
        ];
    }
}
