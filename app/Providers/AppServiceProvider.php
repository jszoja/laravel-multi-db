<?php

namespace App\Providers;

use App\ConnectionResolver;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Setup custom database connection resolver for all models
        $app = Container::getInstance();
        $factory = $app['db.factory'];
        define( 'DYNAMIC_DB', config('database.dynamic_connections.name') );
        Model::setConnectionResolver( new ConnectionResolver( $app, $factory ) );


    }
}
