<?php

namespace App\Services;

class HelloService implements HelloServiceInterface
{
    public function sayHello(string $name): string
    {
        return 'Hello ' . $name;
    }
}