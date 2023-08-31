<?php

namespace App\Services;

interface HelloServiceInterface
{
    public function sayHello(string $name): string;
}