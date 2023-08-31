<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class EnvironmentVarTest extends TestCase
{
    public function testGetEnv()
    {
        $name = env('NAME');

        self::assertEquals('Jhon', $name);
    }

    public function testDefaultEnv()
    {
        $last_name = Env::get('LAST_NAME', 'Doe');

        self:
        assertEquals('Doe', $last_name);
    }
}
