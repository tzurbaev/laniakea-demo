<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Exceptions\BookNotFoundException;
use App\Http\Requests\Books\StoreBookRequest;
use App\Http\Requests\Books\StoreBookRequestV2;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Http\Requests\Books\UpdateBookRequestV2;
use App\Interfaces\Books\BooksGenreFilterInterface;
use App\Interfaces\Books\BookTransformerInterface;
use App\Interfaces\Books\StoreBookRequestInterface;
use App\Interfaces\Books\UpdateBookRequestInterface;
use App\Repositories\BooksRepository;
use App\Resources\BooksResource;
use App\Resources\Filters\BooksGenreFilter;
use App\Resources\Filters\BooksGenreSlugFilter;
use App\Transformers\Books\BookTransformer;
use App\Transformers\Books\BookTransformerV2;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;
use Laniakea\Versions\Interfaces\VersionBinderInterface;
use Laniakea\Versions\Interfaces\VersionedResourceRegistrarInterface;

class BooksResourceRegistrar implements ResourceRegistrarInterface, VersionedResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('book', BooksResource::class, BooksRepository::class, BookNotFoundException::class);
    }

    public function bindVersions(VersionBinderInterface $binder): void
    {
        $binder->bind('v1', [
            StoreBookRequestInterface::class => StoreBookRequest::class,
            UpdateBookRequestInterface::class => UpdateBookRequest::class,
            BookTransformerInterface::class => BookTransformer::class,
            BooksGenreFilterInterface::class => BooksGenreFilter::class,
        ], isDefault: true);

        $binder->bind('v2', [
            StoreBookRequestInterface::class => StoreBookRequestV2::class,
            UpdateBookRequestInterface::class => UpdateBookRequestV2::class,
            BookTransformerInterface::class => BookTransformerV2::class,
            BooksGenreFilterInterface::class => BooksGenreSlugFilter::class,
        ]);
    }
}
