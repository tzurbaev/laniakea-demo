<?php

declare(strict_types=1);

namespace App\Exceptions;

use Laniakea\Exceptions\HttpNotFoundException;

class AuthorNotFoundException extends HttpNotFoundException
{
    public const MESSAGE = 'Author was not found.';
    public const ERROR_CODE = 'authors.not_found';
}
