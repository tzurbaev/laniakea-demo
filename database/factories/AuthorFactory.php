<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'photo_url' => fake()->imageUrl(),
            'country' => fake()->country,
            'bio' => fake()->paragraph,
        ];
    }
}
