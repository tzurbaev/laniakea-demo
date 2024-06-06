<?php

declare(strict_types=1);

namespace App\Actions\Authors;

use App\Http\Requests\Authors\StoreAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorsRepository;

readonly class CreateAuthor
{
    public function __construct(private AuthorsRepository $repository)
    {
        //
    }

    public function create(StoreAuthorRequest $request): Author
    {
        return $this->repository->create([
            'name' => $request->getAuthorName(),
            'photo_url' => $request->getPhotoUrl(),
            'bio' => $request->getBio(),
        ]);
    }
}
