<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContohMiddlewareTest extends TestCase
{
    /** !START TEST Route Middleware */
    public function testIsInvalid()
    {
        $this->get('/response/middleware/contoh')
            ->assertStatus(401)
            ->assertSeeText('Access Denied');
    }

    public function testIsValid()
    {
        $this->withHeader('API_KEY', 'Galih_Roswandi')
            ->get('/response/middleware/contoh')
            ->assertStatus(200)
            ->assertSeeText('Ok');
    }
    /** !END TEST Route Middleware */


    /** !START TEST Group Middleware */
    public function testGroupIsInvalid()
    {
        $this->get('/middleware/group')
        ->assertSeeText('Access Denied')
        ->assertStatus(401);
    }

    public function testGroupIsValid()
    {
        $this->withHeader('API_KEY', 'Galih_Roswandi')
        ->get('/middleware/group')
        ->assertStatus(200)
        ->assertSeeText('Ok');
    }
    /** !END TEST Group Middleware */


    /** !START TEST Param Middleware */
    public function testParamMiddlewareInvalid(){
        $this->get('/middleware/param')
        ->assertSeeText('Access Denied')
        ->assertStatus(401);
    }

    public function testParamMiddlewareValid()
    {
        $this->withHeader('API_KEY', 'Key_123')
        ->get('/middleware/param')
        ->assertStatus(200)
        ->assertSeeText('Ok');
    }
    /** !END TEST Param Middleware */


    /** !START TEST Group Param Middleware */
    public function testGroupParamMiddlewareInvalid()
    {
        $this->get('/middleware/param/group')
        ->assertStatus(401)
        ->assertSeeText('Access Denied');
    }

    public function testGroupParamMiddlewareValid()
    {
        $this->withHeader('API_KEY', 'KEY_654')
        ->get('/middleware/param/group')
        ->assertStatus(200)
        ->assertSeeText('Ok');
    }
    /** !END TEST Group Param Middleware */
}
