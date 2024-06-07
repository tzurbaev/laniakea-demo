<?php

declare(strict_types=1);

namespace App\Forms;

use Laniakea\Forms\Fields\TextareaField;
use Laniakea\Forms\Fields\TextField;
use Laniakea\Forms\FormSection;

class CreateAuthorForm extends AbstractForm
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
        return route('api.v1.authors.store');
    }

    /**
     * Form fields.
     *
     * @return array
     */
    public function getFields(): array
    {
        return [
            'name' => (new TextField('Author Name'))
                ->setHint('Enter the author name.')
                ->setRequired(),
            'photo_url' => (new TextField('Photo URL'))
                ->setHint('Paste the URL of the author photo.')
                ->setRequired(),
            'bio' => (new TextareaField('Biography'))
                ->setHint('Enter the author biography.')
                ->setRows(4),
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
            'photo_url' => null,
            'bio' => '',
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
            new FormSection(['name', 'photo_url', 'bio'], 'General Information', 'Enter the author details.'),
        ];
    }
}
