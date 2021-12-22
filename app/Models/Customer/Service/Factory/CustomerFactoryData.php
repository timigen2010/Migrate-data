<?php

namespace App\Models\Customer\Service\Factory;

class CustomerFactoryData
{
    public string $name;
    public string $email;
    public int $age;
    public string $location;

    public function __construct(string $name,
                                string $email,
                                int $age,
                                string $location)
    {
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
        $this->location = $location;
    }
}
