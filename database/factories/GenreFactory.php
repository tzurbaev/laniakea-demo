<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GenreFactory extends Factory
{
    protected $model = Genre::class;

    public function definition(): array
    {
        $name = $this->faker->word;

        return [
            'slug' => Str::slug($name),
            'name' => $name,
        ];
    }
}
