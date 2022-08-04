<?php

namespace Milwad\LaravelAttributes;

use Illuminate\Support\ServiceProvider;

class LaravelAttributesServiceProvider extends ServiceProvider
{
    /**
     * Get config path.
     *
     * @var string
     */
    private string $config_path = __DIR__ . '/../config/laravel-attributes.php';

    /**
     * Get config name.
     *
     * @var string
     */
    private string $config_name = 'laravel-attributes';

    /**
     * Get migration path.
     *
     * @var string
     */
    private string $migration_path = __DIR__ . '/../migrations/';

    /**
     * Register files.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom($this->migration_path); // Load migrations
        $this->mergeConfigFrom($this->config_path, $this->config_name); // Load config file
        $this->publishPackageFiles(); // Load package files
    }

    /**
     * Load package files.
     *
     * @return void
     */
    private function publishPackageFiles()
    {
        // Publish config
        $this->publishes([
            $this->config_path => config_path("$this->config_name.php")
        ], 'config');

        // Publish migrations
        $this->publishes([
            $this->migration_path => database_path('migrations')
        ], 'migrations');
    }
}
