<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Exceptions\AuthorNotFoundException;
use App\Repositories\AuthorsRepository;
use App\Resources\AuthorsResource;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;

class AuthorsResourceRegistrar implements ResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('author', AuthorsResource::class, AuthorsRepository::class, AuthorNotFoundException::class);
    }
}
