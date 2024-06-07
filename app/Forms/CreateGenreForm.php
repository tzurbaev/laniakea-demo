<?php

declare(strict_types=1);

namespace App\Forms;

use Laniakea\Forms\Fields\TextField;
use Laniakea\Forms\FormSection;

class CreateGenreForm extends AbstractForm
{
    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUrl(): string
    {
        return route('api.v1.genres.store');
    }

    public function getFields(): array
    {
        return [
            'name' => (new TextField('Genre Name'))
                ->setHint('Enter the genre name.')
                ->setRequired(),
        ];
    }

    public function getValues(): array
    {
        return [
            'name' => null,
        ];
    }

    public function getSections(): array
    {
        return [
            new FormSection(['name'], 'General Information', 'General genre information.'),
        ];
    }
}
