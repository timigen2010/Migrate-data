<?php

namespace App\Models\Customer\Service\Factory;

use App\Models\Customer\Entity\Customer;

class CustomerFactory extends CustomerFactoryAbstract
{

    protected function setData(CustomerFactoryData $data, Customer $customer): Customer
    {
        $customer->name = $data->name;
        $customer->email = $data->email;
        $customer->age = $data->age;
        $customer->location = $data->location;
        $customer->save();

        return $customer;
    }
}
