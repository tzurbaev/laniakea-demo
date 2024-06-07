<?php

declare(strict_types=1);

namespace App\Settings;

use Laniakea\Settings\SettingsDecorator;

class BookSettingsDecorator extends SettingsDecorator
{
    /**
     * Determine whether the full synopsis should be shown or not.
     *
     * @return bool
     */
    public function showFullSynopsis(): bool
    {
        return $this->getValue(BookSetting::SHOW_FULL_SYNOPSIS, false) === true;
    }

    /**
     * Get the length of the synopsis. If the full synopsis should be shown, returns null.
     *
     * @return int|null
     */
    public function getSynopsisLength(): ?int
    {
        if ($this->showFullSynopsis()) {
            return null;
        }

        return intval($this->getValue(BookSetting::SYNOPSIS_LENGTH, 100));
    }
}
