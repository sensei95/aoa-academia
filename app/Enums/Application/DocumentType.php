<?php

namespace App\Enums\Application;

use App\Enums\Concerns\HasValues;

enum DocumentType: string
{
    use HasValues;

    case PASSPORT = 'passport';
    case TEMPORARY_RESIDENCE_PERMIT = 'temporary residence permit';
    case RESIDENCE_PERMIT = 'residence permit';
}
