<?php

declare(strict_types=1);

namespace App\Forms;

use Laniakea\Forms\Fields\TextField;
use Laniakea\Forms\FormSection;

class CreateGenreForm extends AbstractForm
{
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
        return route('api.v1.genres.store');
    }

    /**
     * Form fields.
     *
     * @return array
     */
    public function getFields(): array
    {
        return [
            'name' => (new TextField('Genre Name'))
                ->setHint('Enter the genre name.')
                ->setRequired(),
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
            'name' => null,
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
            new FormSection(['name'], 'General Information', 'General genre information.'),
        ];
    }
}
