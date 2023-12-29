<?php

namespace App\Http\Utils;

use Illuminate\Http\Request;

class FileUtils
{

    public static function saveToLocalFromRequest(Request $request, string $key): string
    {
        // const baseUrl = "http://176.100.124.36:8000"
        $baseUrl = "http://127.0.0.1:8000";
        $basePath = '/images/';

        $image_file = $request->file($key);
        $request->validate([
            $key => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $extension = $image_file->getClientOriginalExtension();
        $imageName = time() . '.' . $extension;
        $image_file->move(public_path() . $basePath, $imageName);
        return $baseUrl . $basePath . $imageName;
    }

}
