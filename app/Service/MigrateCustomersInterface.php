<?php

namespace App\Service;

interface MigrateCustomersInterface
{
    public function migrate($filename, $firstRowHeader): array;
}
