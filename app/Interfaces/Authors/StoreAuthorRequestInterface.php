<?php

declare(strict_types=1);

namespace App\Interfaces\Authors;

interface StoreAuthorRequestInterface
{
    /**
     * Get author name.
     *
     * @return string
     */
    public function getAuthorName(): string;

    /**
     * Get author's photo URL.
     *
     * @return string
     */
    public function getPhotoUrl(): string;

    /**
     * Get author's country.
     *
     * @return string|null
     */
    public function getCountry(): ?string;

    /**
     * Get author's short biography.
     *
     * @return string|null
     */
    public function getBio(): ?string;
}
