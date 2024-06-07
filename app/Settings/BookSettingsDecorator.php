<?php

declare(strict_types=1);

namespace App\Settings;

use Laniakea\Settings\SettingsDecorator;

class BookSettingsDecorator extends SettingsDecorator
{
    public function showFullSynopsis(): bool
    {
        return $this->getValue(BookSetting::SHOW_FULL_SYNOPSIS, false) === true;
    }

    public function getSynopsisLength(): ?int
    {
        if ($this->showFullSynopsis()) {
            return null;
        }

        return intval($this->getValue(BookSetting::SYNOPSIS_LENGTH, 100));
    }
}
