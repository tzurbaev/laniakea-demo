<?php

declare(strict_types=1);

namespace App\Http\Requests\Authors;

use App\Interfaces\Authors\StoreAuthorRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest implements StoreAuthorRequestInterface
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'photo_url' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ];
    }

    public function getAuthorName(): string
    {
        return $this->input('name');
    }

    public function getCountry(): ?string
    {
        // API v1 does not have a country field, so we return null
        return null;
    }

    public function getPhotoUrl(): string
    {
        return $this->input('photo_url');
    }

    public function getBio(): ?string
    {
        return $this->input('bio');
    }
}
