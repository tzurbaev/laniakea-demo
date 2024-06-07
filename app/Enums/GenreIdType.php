<?php

declare(strict_types=1);

namespace App\Enums;

enum GenreIdType: string
{
    case ID = 'id';
    case SLUG = 'slug';
}
