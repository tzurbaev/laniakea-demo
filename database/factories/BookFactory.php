<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'author_id' => Author::factory(),
            'genre_id' => Genre::factory(),
            'isbn' => fake()->isbn13(),
            'title' => $this->faker->sentence,
            'synopsis' => $this->faker->paragraph,
            'cover_url' => $this->faker->imageUrl(),
            'settings' => null,
        ];
    }
}
