<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Storage;

class ImageController extends BaseController
{
    public function upload(Request $request)
    {
        $file = $request->file($request->get("fieldName", "file"), null);

        if (!$file) {
            return response()->json("Cannot find `$fieldName` key in sent data", 422);
        }

        $ext = '.' . $file->getClientOriginalExtension();
        $name = str_replace($ext, "", str_slug($file->getClientOriginalName())) . '-' . uniqid() . $ext;

        $img = Image::make($file);
        $img->save();

        $path = Storage::putFileAs("/public/blog/images", new \SplFileInfo($file), $name, 'public');

        return response($path, 200)->header('Content-Type', 'text/plain');

        echo $path;
        die();
        return response()->json([
            "url" => Storage::url($path),
            "path" => $path,
        ]);
    }

    public function fetch(Request $request)
    {
        dd($request->all());
    }
}
