<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Books\CreateBook;
use App\Actions\Books\UpdateBook;
use App\Interfaces\Books\BookTransformerInterface;
use App\Interfaces\Books\StoreBookRequestInterface;
use App\Interfaces\Books\UpdateBookRequestInterface;
use App\Models\Book;
use App\Repositories\BooksRepository;
use App\Resources\BooksResource;
use Illuminate\Http\JsonResponse;
use Laniakea\Resources\Interfaces\ResourceManagerInterface;
use Laniakea\Resources\Interfaces\ResourceRequestInterface;

class BooksApiController
{
    public function index(
        ResourceRequestInterface $request,
        ResourceManagerInterface $manager,
        BookTransformerInterface $transformer,
    ): JsonResponse {
        $paginator = $manager->getPaginator(
            $request,
            new BooksResource(),
            new BooksRepository(),
        );

        return fractal($paginator, $transformer)
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function store(
        StoreBookRequestInterface $request,
        CreateBook $action,
        BookTransformerInterface $transformer,
    ): JsonResponse {
        $book = $action->create($request);

        return fractal($book, $transformer)->respond();
    }

    public function show(
        ResourceRequestInterface $request,
        Book $book,
        BookTransformerInterface $transformer,
    ): JsonResponse {
        return fractal($book, $transformer)
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function update(
        UpdateBookRequestInterface $request,
        UpdateBook $action,
        BookTransformerInterface $transformer,
    ): JsonResponse {
        return fractal($action->update($request, $request->getBook()), $transformer)
            ->respond();
    }
}
