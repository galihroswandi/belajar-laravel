<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function res(Request $request): Response
    {
        return response("Hallo Response", 200);
    }

    public function resHeader(Request $request): Response
    {

        $body = [
            "first_name" => "Jhon",
            "last_name" => "Doe"
        ];

        return response($body, 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                "Author" => "Galih Roswandi",
                "App" => "Belajar Laravel"
            ]);
    }

    public function resView(Request $request): Response
    {
        return response()
            ->view("hello", ["name" => "Jhon Doe"]);
    }

    public function resJson(Request $request): JsonResponse
    {

        $body = [
            "first_name" => "Jhon",
            "last_name" => "Doe"
        ];

        return response()
            ->json($body, 200);
    }

    public function resFile(Request $request): BinaryFileResponse
    {
        return response()
            ->file(storage_path('/app/public/pictures/hello.jpg'));
    }

    public function resDownload(Request $request): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/hello.jpg'), "Fake Laravel.jpg");
    }
}