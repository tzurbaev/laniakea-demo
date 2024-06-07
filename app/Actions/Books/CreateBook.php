<?php

declare(strict_types=1);

namespace App\Actions\Books;

use App\Interfaces\Books\StoreBookRequestInterface;
use App\Models\Book;
use App\Settings\BookSetting;

readonly class CreateBook extends AbstractBookAction
{
    public function create(StoreBookRequestInterface $request): Book
    {
        return $this->repository->create([
            'author_id' => $request->getAuthorId(),
            'genre_id' => $this->getGenreId($request),
            'isbn' => $request->getIsbn(),
            'release_year' => $request->getReleaseYear(),
            'title' => $request->getTitle(),
            'synopsis' => $request->getSynopsis(),
            'cover_url' => $request->getCoverUrl(),

            // SettingsValuesInterface::getSettingsForCreate() allows you to generate settings array for creating model
            // Learn more: https://laniakea.zurbaev.com/settings.html#batch-actions
            'settings' => $this->settingsValues->getSettingsForCreate(BookSetting::class, $request->getSettings()),
        ]);
    }
}
