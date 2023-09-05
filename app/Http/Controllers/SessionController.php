<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        // session()->put("userId", "jhon123");
        // session()->put("isMember", true);

        // $request->session()->put('userId', 'jhon123');
        // $request->session()->put('isMember', true);

        Session::put("userId", "jhon123");
        Session::put("isMember", true);
        return "Ok";
    }

    public function getSession(Request $request): string
    {
        $userId = Session::get('userId', 'guest');
        $isMember = Session::get('isMember', 'false');

        return "userId: $userId, isMember: $isMember";
    }
}