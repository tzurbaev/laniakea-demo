<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Genres\CreateGenre;
use App\Http\Requests\Genres\StoreGenreRequest;
use App\Models\Genre;
use App\Repositories\GenresRepository;
use App\Resources\GenresResource;
use App\Transformers\Genres\GenreTransformer;
use Illuminate\Http\JsonResponse;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class GenresApiController
{
    public function index(ResourceRequestInterface $request, ResourceManagerInterface $manager): JsonResponse
    {
        $paginator = $manager->getPaginator(
            $request,
            new GenresResource(),
            new GenresRepository(),
        );

        return fractal($paginator, new GenreTransformer())
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function store(StoreGenreRequest $request, CreateGenre $action): JsonResponse
    {
        $genre = $action->create($request);

        return fractal($genre, new GenreTransformer())->respond();
    }

    public function show(ResourceRequestInterface $request, Genre $genre): JsonResponse
    {
        return fractal($genre, new GenreTransformer())
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }
}
