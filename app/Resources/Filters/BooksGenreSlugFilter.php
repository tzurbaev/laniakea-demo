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
    public function __construct(private GenresRepository $repository)
    {
        //
    }

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
