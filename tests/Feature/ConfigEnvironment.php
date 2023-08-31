<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigEnvironment extends TestCase
{
    public function testConfig()
    {
        $first = config('contoh.author.first');
        $last = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('Jhon', $first);
        self::assertEquals('Doe', $last);
        self::assertEquals('l2oQ4@example.com', $email);
        self::assertEquals('https://example.com', $web);
    }
}