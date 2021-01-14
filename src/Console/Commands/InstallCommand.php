<?php

namespace Aalcala\Ledger\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ledger:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Ledger config and resources';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->callSilent('vendor:publish', ['--tag' => 'ledger-config']);
        $this->callSilent('vendor:publish', ['--tag' => 'ledger-provider']);

        if (! app()->runningUnitTests()) {
            $this->registerLedgerServiceProvider();
        }

        $this->info('Installation complete.');
    }

    private function registerLedgerServiceProvider()
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());
        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace.'\\Providers\\LedgerServiceProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\EventServiceProvider::class,".$eol,
            "{$namespace}\\Providers\EventServiceProvider::class,".$eol."        {$namespace}\Providers\LedgerServiceProvider::class,".$eol,
            $appConfig
        ));

        file_put_contents(app_path('Providers/LedgerServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers/LedgerServiceProvider.php'))
        ));
    }
}
