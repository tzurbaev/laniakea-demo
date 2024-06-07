<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Exceptions\GenreNotFoundException;
use App\Repositories\GenresRepository;
use App\Resources\GenresResource;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;

class GenresResourceRegistrar implements ResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('genre', GenresResource::class, GenresRepository::class, GenreNotFoundException::class);
    }
}
