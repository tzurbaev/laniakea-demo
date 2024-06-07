<?php

declare(strict_types=1);

namespace App\Settings;

use Laniakea\Settings\Types\BooleanSetting;
use Laniakea\Settings\Types\NullableIntegerSetting;

enum BookSetting: string
{
    // This setting is used to determine whether the full synopsis should be shown or not.
    #[BooleanSetting(true)]
    case SHOW_FULL_SYNOPSIS = 'show_full_synopsis';

    // This setting is used to determine the length of the synopsis (if SHOW_FULL_SYNOPSIS is false).
    #[NullableIntegerSetting(null)]
    case SYNOPSIS_LENGTH = 'synopsis_length';
}
