<?php

namespace App\Enums\Concerns;

trait HasValues
{
    public static function getValues(): array
    {
        $values = [];

        foreach (self::cases() as $item) {
            $values[] = $item->value;
        }

        return $values;
    }
}
