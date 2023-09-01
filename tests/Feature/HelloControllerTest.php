<?php

namespace Tests\Feature;

use Tests\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHelloController()
    {
        $this->get('/controller/hello')
            ->assertSeeText('Hello World From Controller');
    }

    public function testHelloControllerServiceContainer()
    {
        $this->get('/controller/hello/JhonDoe')
            ->assertSeeText('Hello JhonDoe');
    }
}