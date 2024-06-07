<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Forms\CreateAuthorForm;
use Illuminate\View\View;
use Laniakea\Forms\Interfaces\FormsManagerInterface;

class AuthorsController
{
    public function index(): View
    {
        return view('authors', [
            'button' => [
                'url' => route('authors.create'),
                'label' => 'Create Author',
            ],
        ]);
    }

    public function create(FormsManagerInterface $formsManager): View
    {
        return view('create', [
            'heading' => 'Create New Author',
            'form' => $formsManager->getFormJson(new CreateAuthorForm()),
        ]);
    }
}
