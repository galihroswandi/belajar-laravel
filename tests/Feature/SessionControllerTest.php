<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function testCreateSession()
    {
        $this->get('/session/create')
            ->assertSeeText('Ok')
            ->assertSessionHas("userId", "jhon123")
            ->assertSessionHas("isMember", true);
    }

    public function testGetSession()
    {
        $this->withSession([
            "userId" => "user123",
            "isMember" => "true"
        ])->get('/session/get')
            ->assertSeeText('userId: user123, isMember: true');
    }

    public function testGetSessionFailed()
    {
        $this->get('/session/get')
            ->assertSeeText('userId: guest, isMember: false');
    }
}