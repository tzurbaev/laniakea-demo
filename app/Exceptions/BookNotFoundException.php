<?php

declare(strict_types=1);

namespace App\Exceptions;

use Laniakea\Exceptions\HttpNotFoundException;

class BookNotFoundException extends HttpNotFoundException
{
    public const MESSAGE = 'Book was not found.';
    public const ERROR_CODE = 'books.not_found';
}
