<?php

declare(strict_types=1);

namespace App\Resources\Registrars;

use App\Exceptions\AuthorNotFoundException;
use App\Http\Requests\Authors\StoreAuthorRequest;
use App\Http\Requests\Authors\StoreAuthorRequestV2;
use App\Interfaces\Authors\AuthorTransformerInterface;
use App\Interfaces\Authors\StoreAuthorRequestInterface;
use App\Repositories\AuthorsRepository;
use App\Resources\AuthorsResource;
use App\Transformers\Authors\AuthorTransformer;
use App\Transformers\Authors\AuthorTransformerV2;
use Laniakea\Resources\Interfaces\ResourceRegistrarInterface;
use Laniakea\Resources\Interfaces\ResourceRouteBinderInterface;
use Laniakea\Versions\Interfaces\VersionBinderInterface;
use Laniakea\Versions\Interfaces\VersionedResourceRegistrarInterface;

class AuthorsResourceRegistrar implements ResourceRegistrarInterface, VersionedResourceRegistrarInterface
{
    public function bindRoute(ResourceRouteBinderInterface $binder): void
    {
        $binder->bind('author', AuthorsResource::class, AuthorsRepository::class, AuthorNotFoundException::class);
    }

    public function bindVersions(VersionBinderInterface $binder): void
    {
        $binder->bind('v1', [
            StoreAuthorRequestInterface::class => StoreAuthorRequest::class,
            AuthorTransformerInterface::class => AuthorTransformer::class,
        ], isDefault: true);

        $binder->bind('v2', [
            StoreAuthorRequestInterface::class => StoreAuthorRequestV2::class,
            AuthorTransformerInterface::class => AuthorTransformerV2::class,
        ]);
    }
}
