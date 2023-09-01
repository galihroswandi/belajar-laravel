<?php

namespace Tests\Feature;

use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get('/hello')
            ->assertSeeText('Hello Jhon Doe');

        $this->get('/hello-again')
            ->assertSeeText('Hello Jhon Doe');
    }

    public function testNested()
    {
        $this->get('/hello-world')
            ->assertSeeText('World Jhon Doe');
    }

    public function testViewWithoutRoute()
    {
        $this->view('hello', ['name' => 'Jhon'])
            ->assertSeeText('Hello Jhon');

        $this->view('hello.world', ['name' => 'Doe'])
            ->assertSeeText('World Doe');
    }
}