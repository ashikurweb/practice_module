<?php 
namespace App\Console;
use App\Console\Commands\CustomLoad;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CustomLoad::class,
    ];

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}