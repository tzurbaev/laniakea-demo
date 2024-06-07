<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Forms\CreateBookForm;
use App\Forms\EditBookForm;
use App\Models\Book;
use App\Repositories\AuthorsRepository;
use App\Repositories\GenresRepository;
use Illuminate\View\View;
use Laniakea\Forms\Interfaces\FormsManagerInterface;

readonly class BooksController
{
    public function __construct(
        private AuthorsRepository $authorsRepository,
        private GenresRepository $genresRepository,
    ) {
        //
    }

    public function index(): View
    {
        return view('books', [
            'button' => [
                'url' => route('books.create'),
                'label' => 'Create Book',
            ],
            'authors' => $this->authorsRepository->getOptionsList(),
            'genres' => $this->genresRepository->getOptionsList(),
        ]);
    }

    public function create(FormsManagerInterface $formsManager): View
    {
        return view('form', [
            'heading' => 'Create New Book',
            'form' => $formsManager->getFormJson(
                new CreateBookForm(
                    authors: $this->authorsRepository->getOptionsList(),
                    genres: $this->genresRepository->getOptionsList(),
                ),
            ),
        ]);
    }

    public function edit(Book $book, FormsManagerInterface $formsManager): View
    {
        return view('form', [
            'heading' => 'Edit «'.$book->title.'»',
            'form' => $formsManager->getFormJson(
                new EditBookForm(
                    book: $book,
                    authors: $this->authorsRepository->getOptionsList(),
                    genres: $this->genresRepository->getOptionsList(),
                ),
            ),
        ]);
    }
}
