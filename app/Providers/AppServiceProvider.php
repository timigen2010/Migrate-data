<?php

namespace App\Providers;

use App\Console\Commands\MigrateData;
use App\Models\Customer\Service\Factory\CustomerFactory;
use App\Models\Customer\Service\Factory\CustomerFactoryAbstract;
use App\Models\Customer\Service\Factory\CustomerFactoryData;
use App\Service\CleanCustomers;
use App\Service\CleanCustomersInterface;
use App\Service\MigrateCustomers;
use App\Service\MigrateCustomersInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(MigrateData::class)
            ->needs(MigrateCustomersInterface::class)
            ->give(MigrateCustomers::class);

        $this->app->when(MigrateData::class)
            ->needs(CleanCustomersInterface::class)
            ->give(CleanCustomers::class);

        $this->app->when(MigrateCustomers::class)
            ->needs(CustomerFactoryAbstract::class)
            ->give(CustomerFactory::class);

        //
    }
}
