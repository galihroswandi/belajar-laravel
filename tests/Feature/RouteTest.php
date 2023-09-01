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
}