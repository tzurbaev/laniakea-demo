<?php

declare(strict_types=1);

namespace App\Http\Requests\Authors;

use App\Interfaces\Authors\StoreAuthorRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequestV2 extends FormRequest implements StoreAuthorRequestInterface
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'photo_url' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ];
    }

    public function getAuthorName(): string
    {
        return $this->input('full_name');
    }

    public function getCountry(): ?string
    {
        return $this->input('country');
    }

    public function getPhotoUrl(): string
    {
        return $this->input('photo_url');
    }

    public function getBio(): ?string
    {
        return $this->input('biography');
    }
}
