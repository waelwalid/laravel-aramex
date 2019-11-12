<?php

namespace WaelWalid\LaravelAramex;

use Illuminate\Support\ServiceProvider;

class LaravelAramexServiceProvider extends ServiceProvider
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
        /** Publich soap files */
        $this->publishes([
            __DIR__.'/live' => public_path('vendor/aramex/live'),
            __DIR__.'/test' => public_path('vendor/aramex/test'),
        ] , 'aramex');
        /** publish config file */
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('aramex.php'),
        ] , 'aramex');
    }
}
