<?php


namespace Gregdmat\LaravelTestUtilities\Console;


use Illuminate\Console\Command;

class LTUInstaller extends Command
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
