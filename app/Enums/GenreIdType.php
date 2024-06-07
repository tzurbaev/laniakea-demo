<?php

declare(strict_types=1);

namespace App\Enums;

enum GenreIdType: string
{
    // Indicates that in book requests genre_id is an ID.
    // Used by v1 requests.
    case ID = 'id';

    // Indicates that in book requests genre_id is a slug.
    // Used by v2 requests.
    case SLUG = 'slug';
}
