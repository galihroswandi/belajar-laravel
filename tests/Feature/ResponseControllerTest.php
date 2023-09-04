<?php

namespace Tests\Feature;

use Tests\TestCase;

class ResponseControllerTest extends TestCase
{
    public function testHelloController()
    {
        $this->get('/cek/response')
            ->assertSeeText('Hallo Response');
    }

    public function testResHeader()
    {
        $this->get('/cek/response-header')
            ->assertSeeText('Jhon')->assertSeeText('Doe')
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Galih Roswandi')
            ->assertHeader('App', 'Belajar Laravel');
    }

    public function testView()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Jhon Doe');
    }

    public function testJson()
    {
        $this->get('/response/type/json')
            ->assertJson([
                "first_name" => "Jhon",
                "last_name" => "Doe"
            ]);
    }

    public function testFile()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-Type', 'image/jpeg');
    }

    public function testDownload()
    {
        $this->get('/response/type/download')
            ->assertDownload('Fake Laravel.jpg');
    }
}