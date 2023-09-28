<?php

namespace App\Enums\User;

use App\Enums\Concerns\HasValues;
use Filament\Support\Contracts\HasLabel;

enum Sex: string implements HasLabel
{
    use HasValues;

    case FEMALE = 'female';
    case MALE = 'male';


    public function getLabel(): ?string
    {
        return match ($this) {
            self::MALE => "Male",
            self::FEMALE => "Female",
        };
    }
}
