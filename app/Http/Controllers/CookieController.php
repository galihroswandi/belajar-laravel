<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public function responseCookie(Request $request): Response
    {
        return response("Ok", 200)
            ->cookie('User-Id', 'galihroswandi', 1000, '/')
            ->cookie('Is-Member', 'true', 1000, '/');
    }
}