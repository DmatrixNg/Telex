<?php

namespace DMatrix\Telex\Providers;

use Illuminate\Support\ServiceProvider;

class TelexServiceProviderPackages extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('telex.php'),
        ], "telex-config");

        $this->mergeConfigFrom(
            __DIR__.'/../config/services.php', 'service'
        );
    }

    /**
     * Loads a path relative to the package base directory.
     *
     * @param  string  $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf('%s/../%s', __DIR__, $path);
    }
}
