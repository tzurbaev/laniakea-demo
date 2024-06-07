<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Exceptions\BookNotFoundException;
use App\Repositories\BooksRepository;
use App\Resources\BooksResource;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;

class BooksResourceRegistrar implements ResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('book', BooksResource::class, BooksRepository::class, BookNotFoundException::class);
    }
}
