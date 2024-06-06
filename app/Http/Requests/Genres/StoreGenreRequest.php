<?php

declare(strict_types=1);

namespace App\Http\Requests\Genres;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function getGenreName(): string
    {
        return $this->input('name');
    }
}
