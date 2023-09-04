<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieControllerTest extends TestCase
{
    public function testCookie()
    {
        $this->get('/response/cookie')
            ->assertSeeText('Ok')
            ->assertCookie('User-Id', 'galihroswandi')
            ->assertCookie('Is-Member', 'true');
    }
}