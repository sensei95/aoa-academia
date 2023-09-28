<?php

namespace App\DataTransferObjects;

use App\ValueObjects\Address;
use App\ValueObjects\Location;

readonly class ProfileDTO
{
    public function __construct(
        public string $postName,
        public string   $phone,
        public string   $placeOfBirth,
        public string   $dateOfBirth,
        public string   $sex,
        public string   $civilState,
        public Location $location,
        public Address  $address,
        public int      $userId
    )
    {

    }

    public static function fromArray(array $data): self
    {
        return new self(
            postName: $data['post_name'],
            phone: $data['phone'],
            placeOfBirth: $data['place_of_birth'],
            dateOfBirth: $data['date_of_birth'],
            sex: $data['sex'],
            civilState: $data['civil_state'],
            location: new Location(
                country: $data['country'],
                city: $data['city'],
                state: $data['state'],
                postalCode: $data['postal_code']
            ),
            address: new Address(
                number: $data['number'],
                street: $data['street'],
                commune: $data['commune']
            ),
            userId: $data['user_id']
        );
    }

    public function toArray(): array
    {
        return [
            'post_name' => $this->postName,
            'place_of_birth' => $this->placeOfBirth,
            'date_of_birth' => $this->dateOfBirth,
            'sex' => $this->sex,
            'civil_state' => $this->civilState,
            'phone' => $this->phone,
            'country' => $this->location->country,
            'postal_code' => $this->location->postalCode,
            'state' => $this->location->state,
            'city' => $this->location->city,
            'address->number' => $this->address->number,
            'address->street' => $this->address->street,
            'address->commune' => $this->address->commune,
            'user_id' => $this->userId
        ];
    }
}

