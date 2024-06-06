<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Repositories\BooksRepository;
use App\Resources\BooksResource;
use Laniakea\Exceptions\HttpNotFoundException;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;

class BooksResourceRegistrar implements ResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('book', BooksResource::class, BooksRepository::class, new HttpNotFoundException('Book was not found.'));
    }
}
