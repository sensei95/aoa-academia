<?php

namespace App\Enums\Application;

use App\Enums\Concerns\HasValues;

enum DegreeOfStudy: string
{
    use HasValues;
    case ADJUNCT = 'adjunct';
    case POST_GRADUATE = 'postgraduate';
    case ASSISTANT_INTERNSHIP = 'assistant internship';
    case BACHELOR = 'bachelor';
    case ADDITIONAL_PROFESSIONAL_EDUCATION = 'additional professional education';
    case MASTER = 'master';
    case TRAINEESHIP = 'traineeship (residency)';
    case SPECIALITY = 'specialty';
    case SECONDARY_VOCATIONAL_EDUCATION = 'secondary vocational education';
}
