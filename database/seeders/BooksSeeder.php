<?php

namespace Database\Seeders;

class BooksSeeder extends JsonSeeder
{
    protected function getTableName(): string
    {
        return 'books';
    }

    protected function getJsonFileName(): string
    {
        return 'books.json';
    }
}
