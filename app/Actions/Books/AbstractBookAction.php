<?php

declare(strict_types=1);

namespace App\Actions\Books;

use App\Enums\GenreIdType;
use App\Exceptions\GenreNotFoundException;
use App\Interfaces\Books\StoreBookRequestInterface;
use App\Interfaces\Books\UpdateBookRequestInterface;
use App\Repositories\BooksRepository;
use App\Repositories\GenresRepository;
use Laniakea\Settings\Interfaces\SettingsValuesInterface;

abstract readonly class AbstractBookAction
{
    public function __construct(
        protected BooksRepository $repository,
        protected SettingsValuesInterface $settingsValues,
        protected GenresRepository $genresRepository,
    ) {
        //
    }

    protected function getGenreId(StoreBookRequestInterface|UpdateBookRequestInterface $request): int
    {
        if ($request->getGenreIdType() === GenreIdType::ID) {
            return $request->getGenreId();
        }

        $genre = $this->genresRepository->getGenreBySlug($request->getGenreId());

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        return $genre->id;
    }
}
