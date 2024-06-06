<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Genres\StoreGenreRequest;
use App\Models\Genre;
use App\Repositories\GenresRepository;
use App\Resources\GenresResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class GenresApiController
{
    public function index(ResourceRequestInterface $resourceRequest, ResourceManagerInterface $manager): JsonResponse
    {
        $paginator = $manager->getPaginator(
            $resourceRequest,
            new GenresResource(),
            new GenresRepository(),
        );

        return response()->json($paginator);
    }

    public function store(StoreGenreRequest $request, GenresRepository $repository): JsonResponse
    {
        $genre = $repository->create([
            'slug' => Str::slug($request->getGenreName()),
            'name' => $request->getGenreName(),
        ]);

        return response()->json($genre);
    }

    public function show(Genre $genre): JsonResponse
    {
        return response()->json($genre);
    }
}
