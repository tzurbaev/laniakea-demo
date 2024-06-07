<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Forms\CreateGenreForm;
use Illuminate\View\View;
use Laniakea\Forms\Interfaces\FormsManagerInterface;

class GenresController
{
    public function index(): View
    {
        return view('genres', [
            'button' => [
                'url' => route('genres.create'),
                'label' => 'Create Genre',
            ],
        ]);
    }

    public function create(FormsManagerInterface $formsManager): View
    {
        return view('form', [
            'heading' => 'Create New Genre',
            'form' => $formsManager->getFormJson(new CreateGenreForm()),
        ]);
    }
}
