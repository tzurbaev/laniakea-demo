<?php

declare(strict_types=1);

namespace App\Forms;

use Laniakea\Forms\Fields\SelectField;
use Laniakea\Forms\Fields\TextareaField;
use Laniakea\Forms\Fields\TextField;
use Laniakea\Forms\FormSection;

class CreateBookForm extends AbstractForm
{
    public function __construct(private readonly array $authors, private readonly array $genres)
    {
        //
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return route('api.v1.books.store');
    }

    public function getFields(): array
    {
        return [
            'author_id' => (new SelectField('Author'))
                ->setHint('Select the author of the book.')
                ->setOptions($this->authors)
                ->setRequired(),
            'genre_id' => (new SelectField('Genre'))
                ->setHint('Select the genre of the book.')
                ->setOptions($this->genres)
                ->setRequired(),
            'isbn' => (new TextField('ISBN'))
                ->setHint('Enter the ISBN of the book. It will be used as book identifier in API.')
                ->setRequired(),
            'title' => (new TextField('Title'))
                ->setHint('Enter the title of the book.')
                ->setRequired(),
            'cover_url' => (new TextField('Cover URL'))
                ->setHint('Paste the URL of the book cover image.')
                ->setRequired(),
            'synopsis' => (new TextareaField('Synopsis'))
                ->setHint('Enter the synopsis of the book.')
                ->setRows(6),
        ];
    }

    public function getValues(): array
    {
        return [
            'author_id' => null,
            'genre_id' => null,
            'isbn' => null,
            'title' => null,
            'cover_url' => null,
            'synopsis' => null,
        ];
    }

    public function getSections(): array
    {
        return [
            new FormSection(['author_id', 'genre_id'], 'Author and Genre', 'Select the author and genre of the book.'),
            new FormSection(['isbn', 'title', 'cover_url', 'synopsis'], 'Book Details', 'Enter the details of the book.'),
        ];
    }
}