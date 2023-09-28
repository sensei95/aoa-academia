<?php

namespace App\ValueObjects;

class Address
{
    public function __construct(
        public readonly string $number,
        public readonly string $street,
        public readonly string $commune,
    ) {
        
    }

    public function fromArray(array $data) : self {
        return new self(
            number: $data['number'],
            street: $data['street'],
            commune: $data['commune']
        );
    }

    public function toArray() : array {
        return [
            'number' => $this->number,
            'street' => $this->street,
            'commune' => $this->commune,
        ];
    }
}