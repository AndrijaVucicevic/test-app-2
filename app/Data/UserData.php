<?php


namespace App\Data;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        #[MapInputName('first_name')]
        public string $firstName,
        #[MapInputName('last_name')]
        public string $lastName,
        public string $email,
        public string|null $password,
    ) {}


    public function toCreate(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }

    public function toUpdate(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
        ];
    }
}
