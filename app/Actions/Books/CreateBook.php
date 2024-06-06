<?php

declare(strict_types=1);

namespace App\Actions\Books;

use App\Http\Requests\Books\StoreBookRequest;
use App\Models\Book;
use App\Repositories\BooksRepository;

readonly class CreateBook
{
    public function __construct(private BooksRepository $repository)
    {
        //
    }

    public function create(StoreBookRequest $request): Book
    {
        return $this->repository->create([
            'author_id' => $request->getAuthorId(),
            'genre_id' => $request->getGenreId(),
            'isbn' => $request->getIsbn(),
            'title' => $request->getTitle(),
            'synopsis' => $request->getSynopsis(),
            'cover_url' => $request->getCoverUrl(),
        ]);
    }
}
