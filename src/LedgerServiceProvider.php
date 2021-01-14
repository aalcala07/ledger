<?php

namespace Aalcala\Ledger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Aalcala\Ledger\Console\Commands\InstallCommand;

class LedgerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerPublishing();
        $this->registerMigrations();
        $this->registerCommands();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ledger');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/Ledger.php', 'ledger');
        // Register facade
        $this->app->singleton('ledger', function () {
            return new Ledger;
        });
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    /**
     * Publish Config
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/Ledger.php' => config_path('Ledger.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/stubs/providers/LedgerServiceProvider.stub' => app_path(
                    'Providers/LedgerServiceProvider.php'
                ),
            ], 'ledger-provider');
        }
    }

    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    private function registerCommands()
    {
        $this->commands([
            InstallCommand::class
        ]);
    }
}
