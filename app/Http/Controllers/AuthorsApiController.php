<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Authors\CreateAuthor;
use App\Http\Requests\Authors\StoreAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorsRepository;
use App\Resources\AuthorsResource;
use App\Transformers\Authors\AuthorTransformer;
use Illuminate\Http\JsonResponse;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class AuthorsApiController
{
    public function index(ResourceRequestInterface $request, ResourceManagerInterface $manager): JsonResponse
    {
        $paginator = $manager->getPaginator(
            $request,
            new AuthorsResource(),
            new AuthorsRepository(),
        );

        return fractal($paginator, new AuthorTransformer())
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function store(StoreAuthorRequest $request, CreateAuthor $action): JsonResponse
    {
        $author = $action->create($request);

        return fractal($author, new AuthorTransformer())->respond();
    }

    public function show(ResourceRequestInterface $request, Author $author): JsonResponse
    {
        return fractal($author, new AuthorTransformer())
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }
}
