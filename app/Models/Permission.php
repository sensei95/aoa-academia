<?php

namespace App\Models;

use App\Enums\Permission\PermissionAction;
use App\ValueObjects\PermissionData;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function description(): Attribute
    {
        $permissioData = PermissionData::fromName($this->name);
        return Attribute::make(
          get: fn () => PermissionAction::from($permissioData->action)
              ->getDescription($permissioData->resource)
        );
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
