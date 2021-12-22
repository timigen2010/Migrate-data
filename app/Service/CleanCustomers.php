<?php

namespace App\Service;

use App\Models\Customer\Entity\Customer;

class CleanCustomers implements CleanCustomersInterface
{
    public function clean(): void
    {
        Customer::query()->truncate();
    }

}
