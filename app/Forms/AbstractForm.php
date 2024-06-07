<?php

declare(strict_types=1);

namespace App\Forms;

use Laniakea\Forms\AbstractForm as BaseForm;
use Laniakea\Forms\Enums\FormButtonType;
use Laniakea\Forms\FormButton;

abstract class AbstractForm extends BaseForm
{
    /**
     * Get form buttons list.
     *
     * @return array
     */
    public function getButtons(): array
    {
        return [
            new FormButton(FormButtonType::SUBMIT, 'Submit'),
            new FormButton(FormButtonType::LINK, 'Cancel', '/'),
        ];
    }
}
