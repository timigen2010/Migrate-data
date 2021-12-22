<?php

namespace App\Console\Commands;

use App\Service\CleanCustomersInterface;
use App\Service\MigrateCustomersInterface;
use Illuminate\Console\Command;

class MigrateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:migrate {filename} {--first-row-header}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Customer migration';

    /**
     * MigrateCustomersService.
     *
     * @var MigrateCustomersInterface
     */
    protected MigrateCustomersInterface $migrateCustomersService;

    /**
     * CleanCustomersService.
     *
     * @var CleanCustomersInterface
     */
    protected CleanCustomersInterface $cleanCustomersService;

    /**
     * Create a new command instance.
     *
     * @param MigrateCustomersInterface $migrateCustomersService
     */
    public function __construct(MigrateCustomersInterface $migrateCustomersService, CleanCustomersInterface $cleanCustomersService)
    {
        parent::__construct();
        $this->migrateCustomersService = $migrateCustomersService;
        $this->cleanCustomersService = $cleanCustomersService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->cleanCustomersService->clean();
        $this->info("Customers table has been cleaned successfully.");

        try{
            $errors = $this->migrateCustomersService->migrate($this->argument('filename'), $this->option('first-row-header'));
        } catch (\Exception $e){
            $this->info($e->getMessage());
            return 1;
        }

        if($errors){
            $this->info("Valid data has been inserted successfully.");
            $this->info("Uninserted rows are provided in the table below.");
            $this->table(['error', 'original'], $errors);
        } else {
            $this->info("All data has been inserted successfully.");
        }

        return 0;
    }
}
