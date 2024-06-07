<?php

declare(strict_types=1);

namespace App\Interfaces\Books;

use App\Enums\GenreIdType;

interface StoreBookRequestInterface
{
    public function getAuthorId(): int;

    public function getGenreIdType(): GenreIdType;

    public function getGenreId(): int|string;

    public function getIsbn(): string;

    public function getReleaseYear(): ?int;

    public function getTitle(): string;

    public function getCoverUrl(): string;

    public function getSynopsis(): ?string;

    public function getSettings(): array;
}
