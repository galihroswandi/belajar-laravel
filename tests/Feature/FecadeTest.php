<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class FecadeTest extends TestCase
{
    public function testConfig()
    {

        $firstName1 = config('contoh.author.first');

        // !FECADES
        $firstName2 = Config::get('contoh.author.first', 'Jhon');

        self::assertSame($firstName1, $firstName2);
    }

    public function testConfigDependency()
    {

        // !Yang dilakukan fecades
        $config = $this->app->make('config');
        $config->get('contoh.author.first');

        // !Yang dilakukan config
        $firstName1 = config('contoh.author.first');

        // !FECADES => Perintah ini digunakan ketika tidak dapat mengakses app
        $firstName2 = Config::get('contoh.author.first', 'Jhon');

        // var_dump($config->all());

        self::assertSame($firstName1, $firstName2);
    }

    public function testFecadeMock()
    {

        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Jhon Doe Keren');

        $firstName = Config::get('contoh.author.first');

        self::assertEquals('Jhon Doe Keren', $firstName);
    }
}