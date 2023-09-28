<?php

namespace App\DataTransferObjects;

use Illuminate\Support\Facades\Hash;

readonly class UserDTO
{
    public function __construct(
        public string  $firstName,
        public string  $lastName,
        public string  $email,
        public string  $password,
        public ?string $temporary_password = null,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            firstName: $data['first_name'],
            lastName: $data['last_name'],
            email: $data['email'],
            password: Hash::make($data['password']),
            temporary_password: $data['temporary_password']
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
            'temporary_password' => $this->temporary_password
        ];
    }
}
