<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Authors\CreateAuthor;
use App\Http\Requests\Authors\StoreAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorsRepository;
use App\Resources\AuthorsResource;
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

        return response()->json($paginator);
    }

    public function store(StoreAuthorRequest $request, CreateAuthor $action): JsonResponse
    {
        $author = $action->create($request);

        return response()->json($author);
    }

    public function show(Author $author): JsonResponse
    {
        return response()->json($author);
    }
}
