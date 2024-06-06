<?php

declare(strict_types=1);

namespace App\Http\Requests\Authors;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
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

    public function getPhotoUrl(): string
    {
        return $this->input('photo_url');
    }

    public function getBio(): ?string
    {
        return $this->input('bio');
    }
}
