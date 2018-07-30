<?php

namespace Webup\LaravelBlog\Http\Controllers\Admin;

use Webup\LaravelBlog\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class ImageController extends BaseController
{
    public function upload(Request $request)
    {
        $image = $request->file($request->get("fieldName", "file"), null);

        if (!$image) {
            return response()->json("Cannot find `$fieldName` key in sent data", 422);
        }

        return response()->json([
          "url" => "https://via.placeholder.com/350x150",
        ]);
    }
}
