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

    /**
     * Get genre ID.
     * Based on API version the requests' `genre_id` can be either an ID (v1) or a slug (v2).
     *
     * The request's `getGenreIdType()` determines the type of the `genre_id`.
     * If it's GenreIdType::ID, we're going to use the ID as is.
     * Otherwise, we're going to find the genre by the slug and then return its ID.
     *
     * If genre with given slug does not exist, GenreNotFoundException will be thrown
     * and user will receive error message.
     *
     * @param StoreBookRequestInterface|UpdateBookRequestInterface $request
     *
     * @return int
     */
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
