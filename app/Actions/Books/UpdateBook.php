<?php

declare(strict_types=1);

namespace App\Actions\Books;

use App\Http\Requests\Books\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\BooksRepository;

readonly class UpdateBook
{
    public function __construct(private BooksRepository $repository)
    {
        //
    }

    public function update(UpdateBookRequest $request, Book $book): Book
    {
        return $this->repository->update($book->id, [
            'author_id' => $request->getAuthorId(),
            'genre_id' => $request->getGenreId(),
            'isbn' => $request->getIsbn(),
            'title' => $request->getTitle(),
            'synopsis' => $request->getSynopsis(),
            'cover_url' => $request->getCoverUrl(),
        ]);
    }
}
