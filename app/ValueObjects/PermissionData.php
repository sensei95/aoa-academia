<?php

namespace App\ValueObjects;

class PermissionData
{
    public function __construct(
        public readonly string $action,
        public readonly string $resource
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            action: $data['action'],
            resource: $data['resource']
        );
    }

    public static function fromName(string $name): self
    {
        $parts = explode('.', $name);

        return new self(
            action: $parts[1],
            resource: $parts[0]
        );
    }
}
