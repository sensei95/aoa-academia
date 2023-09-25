<?php

namespace App\Enums\Permission;

use App\Enums\Concerns\HasValues;

enum PermissionResource: string
{
    use HasValues;
    case AGENT = 'agent';
    case APPLICANT = 'applicant';

}
