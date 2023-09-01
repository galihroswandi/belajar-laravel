<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputController extends Controller
{
    public function hello(Request $request): string
    {

        $name = $request->input('name');

        return "Hello $name";
    }

    public function nestedInput(Request $request): string
    {
        $name = $request->input('name.first');
        return "Hello $name from nested input";
    }

    public function getAllInput(Request $request): string
    {
        $input = $request->input();

        return json_encode($input);
    }

    public function getAllInputWhereName(Request $request): string
    {
        $input = $request->input('products.*.name');
        return json_encode($input);
    }

    public function getQueryParam(Request $request): string
    {
        $input = $request->query('price');
        return "Harga Product : $input";
    }

    public function getAllQueryParam(Request $request): string
    {
        $input = $request->query();
        return json_encode($input);
    }

    public function inputType(Request $request): string
    {
        $name = $request->input('name');
        $merried = $request->boolean('merried');
        $birth_date = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            "name" => $name,
            "merried" => $merried,
            "birth_date" => $birth_date->format('Y-m-d'),
        ]);
    }

    public function inputOnly(Request $request): string // <== input only berarti yang diambil hanya yang ada di onlynya saja
    {
        $name = $request->only(['name.first', 'name.last']);
        return json_encode($name);
    }

    public function inputExcept(Request $request): string // <== input except berarti yang diambil semua kecuali yang ada di exceptnya
    {
        $account = $request->except(['admin']);
        return json_encode($account);
    }

    public function inputMerge(Request $request): string
    {
        // $account = $request->mergeIfMissing([ // <== mergeIfMissing berarti jika tidak ada maka akan di timpa
        //     "admin" => false
        // ]);
        $request->merge([
            // <== merge berarti jika ada pun maka akan di timpa untuk nilainya
            "admin" => false
        ]);

        $account = $request->input();
        return json_encode($account);
    }
}