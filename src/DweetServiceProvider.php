<?php

namespace KBussche\Dweet;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class DweetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Service', function ($app) { 
            return new Service(new URLBuilder(), new Client(), 'todo');
        });

        //$service = new Service(new URLBuilder(), new Client(), 'todo');
        //$this->app->instance('Service', $service);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
