<?php

namespace Database\Seeders;

class GenresSeeder extends JsonSeeder
{
    protected function getTableName(): string
    {
        return 'genres';
    }

    protected function getJsonFileName(): string
    {
        return 'genres.json';
    }
}
