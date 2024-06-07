<?php

declare(strict_types=1);

namespace App\Interfaces\Books;

use App\Enums\GenreIdType;

interface StoreBookRequestInterface
{
    /**
     * Get author ID.
     *
     * @return int
     */
    public function getAuthorId(): int;

    /**
     * Get genre identifier type.
     *
     * GenreIdType::ID is used in v1 API, while GenreIdType::SLUG is used in v2 API.
     *
     * @return GenreIdType
     */
    public function getGenreIdType(): GenreIdType;

    /**
     * Get genre ID or slug.
     *
     * @return int|string
     */
    public function getGenreId(): int|string;

    /**
     * Get book ISBN.
     *
     * @return string
     */
    public function getIsbn(): string;

    /**
     * Get book release year. API v1 does not support this field, so it can be null.
     *
     * @return int|null
     */
    public function getReleaseYear(): ?int;

    /**
     * Get book title.
     *
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get book's cover URL.
     *
     * @return string
     */
    public function getCoverUrl(): string;

    /**
     * Get book synopsis.
     *
     * @return string|null
     */
    public function getSynopsis(): ?string;

    /**
     * Get additional book settings.
     *
     * @see App\Settings\BooksSettings
     *
     * @return array
     */
    public function getSettings(): array;
}
