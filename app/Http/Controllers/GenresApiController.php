<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Genres\CreateGenre;
use App\Http\Requests\Genres\StoreGenreRequest;
use App\Interfaces\Genres\GenreTransformerInterface;
use App\Models\Genre;
use App\Repositories\GenresRepository;
use App\Resources\GenresResource;
use Illuminate\Http\JsonResponse;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class GenresApiController
{
    public function index(
        ResourceRequestInterface $request,
        ResourceManagerInterface $manager,
        GenreTransformerInterface $transformer,
    ): JsonResponse {
        $paginator = $manager->getPaginator(
            $request,
            new GenresResource(),
            new GenresRepository(),
        );

        return fractal($paginator, $transformer)
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function store(
        StoreGenreRequest $request,
        CreateGenre $action,
        GenreTransformerInterface $transformer,
    ): JsonResponse {
        $genre = $action->create($request);

        return fractal($genre, $transformer)->respond();
    }

    public function show(
        ResourceRequestInterface $request,
        Genre $genre,
        GenreTransformerInterface $transformer,
    ): JsonResponse {
        return fractal($genre, $transformer)
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }
}
