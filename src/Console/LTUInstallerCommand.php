<?php


namespace Gregdmat\LaravelTestUtilities\src\Console;


use Illuminate\Console\Command;

class LTUInstallerCommand extends Command
{
    protected $signature = 'ltu:install';

    public function handle()
    {
        copy(
            __DIR__ . '/../config/ltu.php',
            config_path('ltu.php')
        );
    }
}
