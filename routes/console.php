<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CustomCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Register the custom command
Artisan::command('custom:command {name} {--option=default}', function () {
    $name = $this->argument('name');
    $option = $this->option('option');
    
    $this->info("Hello {$name}!");
    $this->comment("Option value: {$option}");
    
    // Add your custom logic here
    $this->info('Command executed successfully!');
})->purpose('A custom console command example');
