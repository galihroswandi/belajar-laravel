<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    public function testUpload()
    {
        $image = UploadedFile::fake()->image('hello.jpg');

        $this->post('/file/upload', [
            'picture' => $image,
        ])->assertSeeText('Ok hello.jpg');
    }
}