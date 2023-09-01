<?php

namespace App\Http\Controllers;

use App\Services\HelloServiceInterface;
use Illuminate\Http\Request;

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

    public function helloRequest(Request $request): string
    {
        return $request->path() . PHP_EOL .
            $request->url() . PHP_EOL .
            $request->fullUrl() . PHP_EOL .
            $request->method() . PHP_EOL .
            $request->header('Accept') . PHP_EOL;
    }
}