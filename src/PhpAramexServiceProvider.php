<?php

namespace Waelwalid\PhpAramex;

use Illuminate\Support\ServiceProvider;

class PhpAramexServiceProvider extends ServiceProvider
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
            __DIR__.'/live' => public_path('vendor/aramex/live'),
            __DIR__.'/test' => public_path('vendor/aramex/test'),
        ] , 'aramex');
    }
}
