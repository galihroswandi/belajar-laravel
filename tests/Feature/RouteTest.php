<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testGet()
    {
        $this->get('/testing')
            ->assertStatus(200)
            ->assertSee('Hello Jhon Doe For Testing...');
    }

    public function testRedirect()
    {
        $this->get('/test')
            ->assertRedirect('/testing');
    }

    public function testFallback()
    {
        $this->get('/404')
            ->assertSeeText('404 Not Found');

        $this->get('/tidak-ada')
            ->assertSeeText('404 Not Found');
    }

    public function testRouteParameter()
    {
        $this->get('/hello/Jhon-Doe')
            ->assertSeeText('Hello my name is Jhon-Doe');

        $this->get('/hello/Jhon')
            ->assertSeeText('Hello my name is Jhon');

        $this->get('/hello/Jhon-Doe/ages/20')
            ->assertSeeText('Hello my name is Jhon-Doe and my age is 20');

        $this->get('/hello/Jhon/ages/20')
            ->assertSeeText('Hello my name is Jhon and my age is 20');
    }
}