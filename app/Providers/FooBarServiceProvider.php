<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        HelloServiceInterface::class => HelloService::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        echo "Hello Service Provider";
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    // public function provides(): array
    // {
    //     return [HelloServiceInterface::class, Foo::class, Bar::class];
    // }
}