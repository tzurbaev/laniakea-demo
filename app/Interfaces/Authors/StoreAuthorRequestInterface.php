<?php

declare(strict_types=1);

namespace App\Interfaces\Authors;

interface StoreAuthorRequestInterface
{
    public function getAuthorName(): string;

    public function getPhotoUrl(): string;

    public function getCountry(): ?string;

    public function getBio(): ?string;
}
