<?php

namespace App\Enums\User;

use App\Enums\Concerns\HasValues;

enum Sex:string
{
    use HasValues;
    CASE FEMALE = 'female';
    CASE MALE = 'male';
}
