<?php

namespace App\Enums\User;

use App\Enums\Concerns\HasValues;

enum CivilState: string
{
    use HasValues;

    case MARRIED = 'married';
    case SINGLE = 'single';

}
