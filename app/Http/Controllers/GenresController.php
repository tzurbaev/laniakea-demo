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
        return view('genres');
    }

    public function create(FormsManagerInterface $formsManager): View
    {
        return view('create', [
            'heading' => 'Create New Genre',
            'form' => $formsManager->getFormJson(new CreateGenreForm()),
        ]);
    }
}
