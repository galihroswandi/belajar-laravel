<?php

namespace App\Http\Controllers;

use App\Services\HelloServiceInterface;

class HelloController extends Controller
{

    private HelloServiceInterface $HelloServiceInterface;

    public function __construct(HelloServiceInterface $HelloServiceInterface)
    {
        $this->HelloServiceInterface = $HelloServiceInterface;
    }

    public function hello(): string
    {
        return "Hello World From Controller";
    }

    public function helloName($name): string
    {
        return $this->HelloServiceInterface->sayHello($name);
    }
}