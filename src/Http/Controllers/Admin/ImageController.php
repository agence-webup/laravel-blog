<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Storage;

class ImageController extends BaseController
{
    public function upload(Request $request)
    {
        $fieldName = $request->get("fieldName", "file");
        $file = $request->file($fieldName, null);

        if (!$file) {
            return response()->json("Cannot find `$fieldName` key in sent data", 422);
        }

        $ext = '.' . $file->getClientOriginalExtension();
        $name = str_replace($ext, "", str_slug($file->getClientOriginalName())) . '-' . uniqid() . $ext;


        $path = Storage::putFileAs("/public/blog/images", new \SplFileInfo($file), $name, 'public');


        return response(Storage::url($path), 200)->header('Content-Type', 'text/plain');
    }
}
