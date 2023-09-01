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

    public function testHelloControllerRequest()
    {
        $this->get('/controller/hello/request', ['Accept' => 'plain/text'])
            ->assertSeeText('controller/hello/request')
            ->assertSeeText('http://localhost/controller/hello/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text');
    }
}