<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Books\CreateBook;
use App\Http\Requests\Books\StoreBookRequest;
use App\Models\Book;
use App\Repositories\BooksRepository;
use App\Resources\BooksResource;
use Illuminate\Http\JsonResponse;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class BooksApiController
{
    public function index(ResourceRequestInterface $request, ResourceManagerInterface $manager): JsonResponse
    {
        $paginator = $manager->getPaginator(
            $request,
            new BooksResource(),
            new BooksRepository(),
        );

        return response()->json($paginator);
    }

    public function store(StoreBookRequest $request, CreateBook $action): JsonResponse
    {
        $book = $action->create($request);

        return response()->json($book);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }
}
