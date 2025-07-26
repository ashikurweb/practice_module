<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CustomLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run fresh migrations and generate app key if needed';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting application setup...');

        if (!$this->generateAppKey()) {
            return Command::FAILURE;
        }

        if (!$this->runMigrations()) {
            return Command::FAILURE;
        }

        $this->info('Application setup completed successfully!');
        
        return Command::SUCCESS;
    }

    /**
     * Generate the application key if it is not set.
     */
    protected function generateAppKey(): bool
    {
        $appKey = config('app.key');

        if (empty($appKey)) {
            $this->info('Generating application key...');
            
            try {
                Artisan::call('key:generate', [], $this->getOutput());
                return true;
            } catch (\Exception $e) {
                $this->error('Failed to generate application key: ' . $e->getMessage());
                return false;
            }
        }

        $this->info('Application key already exists. Skipping...');
        return true;
    }

    /**
     * Run fresh migrations.
     */
    protected function runMigrations(): bool
    {
        $this->info('Running fresh migrations...');

        try {
            Artisan::call('migrate:fresh', [], $this->getOutput());
            return true;
        } catch (\Exception $e) {
            $this->error('Failed to run migrations: ' . $e->getMessage());
            return false;
        }
    }
}