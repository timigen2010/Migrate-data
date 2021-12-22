<?php

namespace App\Models\Customer\Service\Factory;

use App\Models\Customer\Entity\Customer;
use Illuminate\Database\Eloquent\Model;

abstract class CustomerFactoryAbstract
{
    abstract protected function setData(CustomerFactoryData $data, Customer $customer): Customer;

    public function create(CustomerFactoryData $data): Customer
    {
        $customer = Customer::query()->make();
        return $this->setData($data, $customer);
    }
}
