<?php

declare(strict_types=1);

namespace App\Exceptions;

use Laniakea\Exceptions\HttpNotFoundException;

class GenreNotFoundException extends HttpNotFoundException
{
    public const MESSAGE = 'Genre was not found.';
    public const ERROR_CODE = 'genres.not_found';
}
