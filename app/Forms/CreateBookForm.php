<?php

declare(strict_types=1);

namespace App\Forms;

use Laniakea\Forms\Fields\CheckboxField;
use Laniakea\Forms\Fields\SelectField;
use Laniakea\Forms\Fields\TextareaField;
use Laniakea\Forms\Fields\TextField;
use Laniakea\Forms\FormSection;

class CreateBookForm extends AbstractForm
{
    /**
     * @param array $authors List of authors for select field.
     * @param array $genres  List of genres for select field.
     */
    public function __construct(private readonly array $authors, private readonly array $genres)
    {
        //
    }

    /**
     * HTTP method that will be used to submit the form.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return 'POST';
    }

    /**
     * Form submission URL.
     *
     * @return string
     */
    public function getUrl(): string
    {
        return route('api.v1.books.store');
    }

    /**
     * Form fields.
     *
     * @return array
     */
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
            'show_full_synopsis' => (new CheckboxField('Show full synopsis'))
                ->setHint('If enabled, the full synopsis will be shown on books list page.'),
            'synopsis_length' => (new TextField('Truncated Synopsis length'))
                ->setHint('Enter the length of the synopsis to be shown on books list page. Only works if full synopsis is disabled.')
                ->setInputType('number')
                ->setMinValue(0)
                ->setStep(1),
        ];
    }

    /**
     * Form values.
     *
     * @return array
     */
    public function getValues(): array
    {
        return [
            'author_id' => null,
            'genre_id' => null,
            'isbn' => null,
            'title' => null,
            'cover_url' => null,
            'synopsis' => null,
            'show_full_synopsis' => true,
            'synopsis_length' => '',
        ];
    }

    /**
     * Form sections.
     *
     * @return array
     */
    public function getSections(): array
    {
        return [
            new FormSection(['author_id', 'genre_id'], 'Author and Genre', 'Select the author and genre of the book.'),
            new FormSection(['isbn', 'title', 'cover_url', 'synopsis'], 'Book Details', 'Enter the details of the book.'),
            new FormSection(['show_full_synopsis', 'synopsis_length'], 'Synopsis Settings', 'Configure the synopsis settings.'),
        ];
    }
}
