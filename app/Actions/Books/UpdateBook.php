<?php

declare(strict_types=1);

namespace App\Actions\Books;

use App\Interfaces\Books\UpdateBookRequestInterface;
use App\Models\Book;

readonly class UpdateBook extends AbstractBookAction
{
    /**
     * Update given book.
     *
     * @param UpdateBookRequestInterface $request
     * @param Book                       $book
     *
     * @return Book
     */
    public function update(UpdateBookRequestInterface $request, Book $book): Book
    {
        return $this->repository->update($book->id, [
            'author_id' => $request->getAuthorId(),
            'genre_id' => $this->getGenreId($request),
            'isbn' => $request->getIsbn(),
            'release_year' => $request->getReleaseYear(),
            'title' => $request->getTitle(),
            'synopsis' => $request->getSynopsis(),
            'cover_url' => $request->getCoverUrl(),

            // SettingsValuesInterface::getSettingsForUpdate() allows you to generate settings array for updating model
            // Learn more: https://laniakea.zurbaev.com/settings.html#batch-actions
            'settings' => $this->settingsValues->getSettingsForUpdate($book, $request->getSettings()),
        ]);
    }
}
