<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceInterface;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testConfig()
    {
        $foo1 = $this->app->make(Foo::class); // new Foo();
        $foo2 = $this->app->make(Foo::class); // new Foo();

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }



    public function testBind()
    {
        $this->app->bind(Person::class, function ($app) {
            return new Person('Galih', 'Roswandi');
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals('Galih', $person1->first_name); // !closure // !new Person('Galih', 'Roswandi');
        self::assertEquals('Roswandi', $person1->last_name); // !closure // !new Person('Galih', 'Roswandi');

        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        $this->app->singleton(Person::class, function ($app) {
            return new Person('Galih', 'Roswandi');
        });

        $person1 = $this->app->make(Person::class); // new Person("Galih", "Roswandi"); is not existing
        $person2 = $this->app->make(Person::class); // return existing

        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {

        $person = new Person('Jhon', 'Doe');
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person

        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app) {
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);


        self::assertSame($foo, $bar2->foo);

        self::assertSame($bar1, $bar2);
    }

    public function testBindInterfaceToClass()
    {
        // $this->app->singleton(HelloServiceInterface::class, HelloService::class);

        $this->app->singleton(HelloServiceInterface::class, function ($app) {
            return new HelloService();
        });

        $hello = $this->app->make(HelloServiceInterface::class);

        self::assertSame('Hello JhonDoe', $hello->sayHello('JhonDoe'));
    }
}