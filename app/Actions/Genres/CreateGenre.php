<?php

declare(strict_types=1);

namespace App\Actions\Genres;

use App\Http\Requests\Genres\StoreGenreRequest;
use App\Models\Genre;
use App\Repositories\GenresRepository;
use Illuminate\Support\Str;

readonly class CreateGenre
{
    public function __construct(private GenresRepository $repository)
    {
        //
    }

    /**
     * Create new genre.
     *
     * @param StoreGenreRequest $request
     *
     * @return Genre
     */
    public function create(StoreGenreRequest $request): Genre
    {
        return $this->repository->create([
            'slug' => Str::slug($request->getGenreName()),
            'name' => $request->getGenreName(),
        ]);
    }
}
