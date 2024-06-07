<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Exceptions\GenreNotFoundException;
use App\Interfaces\Genres\GenreTransformerInterface;
use App\Repositories\GenresRepository;
use App\Resources\GenresResource;
use App\Transformers\Genres\GenreTransformer;
use App\Transformers\Genres\GenreTransformerV2;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;
use Laniakea\Versions\Interfaces\VersionBinderInterface;
use Laniakea\Versions\Interfaces\VersionedResourceRegistrarInterface;

class GenresResourceRegistrar implements ResourceRegistrarInterface, VersionedResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('genre', GenresResource::class, GenresRepository::class, GenreNotFoundException::class);
    }

    public function bindVersions(VersionBinderInterface $binder): void
    {
        $binder->bind('v1', [
            GenreTransformerInterface::class => GenreTransformer::class,
        ]);

        $binder->bind('v2', [
            GenreTransformerInterface::class => GenreTransformerV2::class,
        ]);
    }
}
