<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Services\HelloServiceInterface;
use Tests\TestCase;

class FooBarServiceProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        self::assertSame($foo1, $foo2);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($bar1, $bar2);

        self::assertSame($foo1, $bar1->foo);
    }

    public function testSingletons()
    {
        $hello1 = $this->app->make(HelloServiceInterface::class);
        $hello2 = $this->app->make(HelloServiceInterface::class);

        self::assertSame($hello1, $hello2);

        self::assertEquals('Hello Jhondoe', $this->app->make(HelloServiceInterface::class)->sayHello('Jhondoe'));
    }
}