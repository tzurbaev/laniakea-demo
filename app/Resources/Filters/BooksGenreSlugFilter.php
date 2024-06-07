<?php

declare(strict_types=1);

namespace App\Resources\Filters;

use App\Exceptions\GenreNotFoundException;
use App\Interfaces\Books\BooksGenreFilterInterface;
use App\Repositories\GenresRepository;
use Laniakea\Repositories\Criteria\ExactValueCriterion;
use Laniakea\Repositories\Interfaces\RepositoryQueryBuilderInterface;
use Laniakea\Resources\Interfaces\ResourceFilterInterface;

readonly class BooksGenreSlugFilter implements ResourceFilterInterface, BooksGenreFilterInterface
{
    /**
     * @param GenresRepository $repository Laniakea will auto-inject this repository with the help of Laravel.
     */
    public function __construct(private GenresRepository $repository)
    {
        //
    }

    /**
     * This filter is used in API v2 to filter books by genre slug.
     *
     * @param RepositoryQueryBuilderInterface $query
     * @param mixed                           $value
     * @param array                           $values
     */
    public function apply(RepositoryQueryBuilderInterface $query, mixed $value, array $values): void
    {
        if (empty($value)) {
            return;
        }

        $genre = $this->repository->getGenreBySlug($value);

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        // Use built-in criterion to apply filter.
        $query->addCriteria([
            new ExactValueCriterion('genre_id', $genre->id),
        ]);
    }
}
