<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Storage;

class FileStorageTest extends TestCase
{
    public function testFileStorage()
    {
        $filesystem = Storage::disk("local");

        $filesystem->put('file.txt', 'Hello Jhon Doe');

        $content = $filesystem->get('file.txt');

        $this->assertEquals('Hello Jhon Doe', $content);
    }

    public function testPublic()
    {
        $filesystem = Storage::disk('public');

        $filesystem->put('file.txt', 'Hello Jhon Doe');

        $content = $filesystem->get('file.txt');

        $this->assertEquals('Hello Jhon Doe', $content);
    }
}