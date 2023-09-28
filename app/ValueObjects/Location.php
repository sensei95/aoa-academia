<?php

namespace App\ValueObjects;

class Location
{
    public function __construct(
        public readonly string $country,
        public readonly string $city,
        public readonly string $state,
        public readonly string $postalCode
    ) {
        
    }

    public function fromArray(array $data) : self {
        return new self(
            country: $data['country'],
            postalCode: $data['postal_code'],
            state: $data['state'],
            city: $data['city'],
        );
    }


    public function toArray(): array
    {
        return [
            'country' => $this->country,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postalCode
        ];
    }
}