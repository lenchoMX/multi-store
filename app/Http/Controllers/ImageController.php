<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    public function show(string $filename): Response
    {
        $path = storage_path('app/private/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header("Content-Type", $type);
    }
}