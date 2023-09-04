<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncriptionTest extends TestCase
{
    public function testEncription()
    {
        $name = Crypt::encrypt("Galih Roswandi");
        var_dump($name);

        $nameDecript = Crypt::decrypt($name);
        $this->assertEquals('Galih Roswandi', $nameDecript);
    }
}