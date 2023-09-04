<?php

namespace Tests\Feature;

use Tests\TestCase;

class RedirectControllerTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('/response/redirect/from')
            ->assertRedirect('/response/redirect/to');
    }

    public function testRedirectName()
    {
        $this->get('/response/redirect/name')
            ->assertRedirect('/response/redirect/name/JhonDoe');
    }

    public function testRedirectAction()
    {
        $this->get('/response/redirect/action')
            ->assertRedirect('/response/redirect/name/JhonDoe');
    }

    public function testRedirectAway()
    {
        $this->get('/response/redirect/away')
            ->assertRedirect('https://galihroswandi.vercel.app');
    }
}