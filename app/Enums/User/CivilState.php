<?php

namespace App\Enums\User;

use App\Enums\Concerns\HasValues;
use Filament\Support\Contracts\HasLabel;

enum CivilState: string implements HasLabel
{
    use HasValues;

    case MARRIED = 'married';
    case SINGLE = 'single';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::MARRIED => "Married",
            self::SINGLE => "Single",
        };
    }

}
