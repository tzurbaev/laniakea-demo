<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Authors\CreateAuthor;
use App\Interfaces\Authors\AuthorTransformerInterface;
use App\Interfaces\Authors\StoreAuthorRequestInterface;
use App\Models\Author;
use App\Repositories\AuthorsRepository;
use App\Resources\AuthorsResource;
use Illuminate\Http\JsonResponse;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class AuthorsApiController
{
    public function index(
        ResourceRequestInterface $request,
        ResourceManagerInterface $manager,
        AuthorTransformerInterface $transformer,
    ): JsonResponse {
        $paginator = $manager->getPaginator(
            $request,
            new AuthorsResource(),
            new AuthorsRepository(),
        );

        return fractal($paginator, $transformer)
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function store(
        StoreAuthorRequestInterface $request,
        CreateAuthor $action,
        AuthorTransformerInterface $transformer,
    ): JsonResponse {
        $author = $action->create($request);

        return fractal($author, $transformer)->respond();
    }

    public function show(
        ResourceRequestInterface $request,
        Author $author,
        AuthorTransformerInterface $transformer,
    ): JsonResponse {
        return fractal($author, $transformer)
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }
}
