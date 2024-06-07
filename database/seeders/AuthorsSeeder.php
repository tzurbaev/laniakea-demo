<?php

namespace Database\Seeders;

class AuthorsSeeder extends JsonSeeder
{
    protected function getTableName(): string
    {
        return 'authors';
    }

    protected function getJsonFileName(): string
    {
        return 'authors.json';
    }
}
