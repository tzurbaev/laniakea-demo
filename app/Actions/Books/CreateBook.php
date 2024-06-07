<?php

declare(strict_types=1);

namespace App\Actions\Books;

use App\Http\Requests\Books\StoreBookRequest;
use App\Models\Book;
use App\Repositories\BooksRepository;
use App\Settings\BookSetting;
use Laniakea\Settings\Interfaces\SettingsValuesInterface;

readonly class CreateBook
{
    public function __construct(
        private BooksRepository $repository,
        private SettingsValuesInterface $settingsValues,
    ) {
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

            // SettingsValuesInterface::getSettingsForCreate() allows you to generate settings array for creating model
            // Learn more: https://laniakea.zurbaev.com/settings.html#batch-actions
            'settings' => $this->settingsValues->getSettingsForCreate(BookSetting::class, $request->getSettings()),
        ]);
    }
}
