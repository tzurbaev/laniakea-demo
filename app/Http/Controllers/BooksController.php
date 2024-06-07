<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Forms\CreateBookForm;
use App\Repositories\AuthorsRepository;
use App\Repositories\GenresRepository;
use Illuminate\View\View;
use Laniakea\Forms\Interfaces\FormsManagerInterface;

class BooksController
{
    public function index(
        AuthorsRepository $authorsRepository,
        GenresRepository $genresRepository,
    ): View {
        return view('books', [
            'button' => [
                'url' => route('books.create'),
                'label' => 'Create Book',
            ],
            'authors' => $authorsRepository->getOptionsList(),
            'genres' => $genresRepository->getOptionsList(),
        ]);
    }

    public function create(
        FormsManagerInterface $formsManager,
        AuthorsRepository $authorsRepository,
        GenresRepository $genresRepository,
    ): View {
        return view('create', [
            'heading' => 'Create New Book',
            'form' => $formsManager->getFormJson(
                new CreateBookForm(
                    authors: $authorsRepository->getOptionsList(),
                    genres: $genresRepository->getOptionsList(),
                ),
            ),
        ]);
    }
}
