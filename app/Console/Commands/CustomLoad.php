<?php 

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CustomLoad extends Command
{
    protected $signature = 'custom:load';
    protected $description = 'Run migrate:fresh';

    public function handle(): void
    {
        $this->generateAppKey();
        $this->runMigrations();
    }
    /**
     * Generate the application key if it is not set.
     * 
     * @return void
     */
    protected function generateAppKey()
    {
        if (empty(config('APP_KEY'))) {
            rescue(
                fn() => Artisan::call('key:generate'),
                fn($e) => $this->error('key:generate failed' . $e->getMessage()),
            );
        }else {
            $this->info('APP_KEY already exists. Skipping...');
        }
    }

    protected function runMigrations()
    {
        rescue(
            fn() => Artisan::call('migrate:fresh'),
            fn($e) => $this->error('migrate:fresh failed' . $e->getMessage()),
        );
    }
}