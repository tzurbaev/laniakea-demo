<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Books\CreateBook;
use App\Actions\Books\UpdateBook;
use App\Http\Requests\Books\StoreBookRequest;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Models\Book;
use App\Repositories\BooksRepository;
use App\Resources\BooksResource;
use App\Transformers\Books\BookTransformer;
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

        return fractal($paginator, new BookTransformer())
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function store(StoreBookRequest $request, CreateBook $action): JsonResponse
    {
        $book = $action->create($request);

        return fractal($book, new BookTransformer())->respond();
    }

    public function show(ResourceRequestInterface $request, Book $book): JsonResponse
    {
        return fractal($book, new BookTransformer())
            ->parseIncludes($request->getInclusions()) // Make sure to pass list of inclusions to the fractal transformer.
            ->respond();
    }

    public function update(UpdateBookRequest $request, UpdateBook $action): JsonResponse
    {
        return fractal($action->update($request, $request->getBook()), new BookTransformer())
            ->respond();
    }
}
