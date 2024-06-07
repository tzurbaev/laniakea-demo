<?php

declare(strict_types=1);

namespace App\Actions\Authors;

use App\Interfaces\Authors\StoreAuthorRequestInterface;
use App\Models\Author;
use App\Repositories\AuthorsRepository;

readonly class CreateAuthor
{
    public function __construct(private AuthorsRepository $repository)
    {
        //
    }

    public function create(StoreAuthorRequestInterface $request): Author
    {
        return $this->repository->create([
            'name' => $request->getAuthorName(),
            'photo_url' => $request->getPhotoUrl(),
            'bio' => $request->getBio(),
            'country' => $request->getCountry(),
        ]);
    }
}
