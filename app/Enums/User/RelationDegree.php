<?php

namespace App\Enums\User;

use App\Enums\Concerns\HasValues;

enum RelationDegree: string
{
    use HasValues;

    case FATHER = 'father';
    case MOTHER = 'mother';
    case AUNT = 'aunt';
    case UNCLE = 'uncle';
    case WIFE = 'wife';
    case HUSBAND = 'husband';
    case SISTER = 'sister';
    case BROTHER = 'brother';
    case GRAND_MOTHER = 'grand mother';
    case GRAND_FATHER = 'grand father';
    case OTHER = 'other';

}
