<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/controller/input?name=JhonDoe')
            ->assertSeeText('Hello JhonDoe');

        $this->post('/controller/input', ["name" => "Galih Roswandi"])
            ->assertSeeText('Hello Galih Roswandi');
    }

    public function testNestedInput()
    {
        $this->post('/controller/nestedInput', [
            "name" => [
                "first" => "Galih",
                "last" => "Roswandi"
            ]
        ])->assertSeeText('Hello Galih from nested input');
    }

    public function testgetAllInput()
    {
        $this->post('/controller/getAllInput', [
            "name" => [
                "first" => "Jhon",
                "last" => "Doe",
                "middle" => "xxx"
            ],
            "age" => "20",
            "gender" => "male"
        ])->assertSeeText('name')->assertSeeText('first');
    }

    public function testGetAllInputWhereName()
    {
        $this->post('/controller/getAllInputWhereName', [
            "products" => [
                [
                    "name" => "Product 1",
                    "price" => 100,
                    "stock" => 10
                ],
                [
                    "name" => "Product 2",
                    "price" => 200,
                    "stock" => 20
                ]
            ]
        ])
            ->assertSeeText('Product 1')
            ->assertSeeText('Product 2');
    }

    public function testGetQueryParam()
    {
        $this->get('/controller/getQueryParam?price=1000')
            ->assertSeeText('Harga Product : 1000');
    }

    public function testGetAllQueryParam()
    {
        $this->get('/controller/getAllQueryParam?name=Product 1?price=1000')->assertSeeText('name')->assertSeeText('price');
    }

    public function testInputType()
    {
        $this->post('/controller/inputType', [
            "name" => "Jhon Doe",
            "merried" => true,
            "birth_date" => "2000-01-01"
        ])->assertSeeText('name')->assertSeeText('merried')->assertSeeText('birth_date');
    }
}