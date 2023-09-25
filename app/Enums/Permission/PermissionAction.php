<?php

namespace App\Enums\Permission;

use App\Enums\Concerns\HasValues;

enum PermissionAction: string
{

    use HasValues;
    case VIEW_ANY = 'viewAny';
    case ViEW = 'view';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case RESTORE = 'restore';
    case FORCE_DELETE = 'forceDelete';

    public function getDescription(string $resourceName): string
    {
        return match ($this) {
            self::VIEW_ANY => "Can view any $resourceName",
            self::ViEW => "Can view a (an) $resourceName",
            self::CREATE => "Can create a (an) $resourceName",
            self::UPDATE => "Can update a (an) $resourceName",
            self::DELETE => "Can delete a (an) $resourceName",
            self::RESTORE => "Can restore a (an) $resourceName",
            self::FORCE_DELETE => "Can force delete a (an) $resourceName",
        };
    }
}
