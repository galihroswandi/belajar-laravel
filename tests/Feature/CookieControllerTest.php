<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get('/response/cookie/set')
            ->assertSeeText('Ok')
            ->assertCookie('User-Id', 'galihroswandi')
            ->assertCookie('Is-Member', 'true');
    }

    public function testGetCookie()
    {
        $this->withCookie('User-Id', 'galihroswandi')
            ->withCookie('Is-Member', 'true')
            ->get('/response/cookie/get')
            ->assertJson([
                "userId" => "galihroswandi",
                "isMember" => "true",
            ]);
    }
}