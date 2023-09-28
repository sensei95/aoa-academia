<?php
namespace App\Enums\User;

enum UserRole: string
{
    case SUPER_ADMIN = 'super admin';
    case ADMIN = 'admin';
    case APPLICANT = 'applicant';
    case AGENT = 'agent';
}
