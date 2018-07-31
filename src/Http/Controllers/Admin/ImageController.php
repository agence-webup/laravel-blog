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

        $ext = '.'.$file->getClientOriginalExtension();
        $name = str_replace($ext, "", str_slug($file->getClientOriginalName())).'-'.uniqid().$ext;

        $img = $this->resizeIfOutOfBounds(Image::make($file), 500, 500);
        $img->save();

        $path = Storage::putFileAs("/public/blog/images", new \SplFileInfo($file), $name, 'public');

        return response()->json([
            "url" => Storage::url($path),
            "path" => $path,
        ]);
    }

    private function resizeIfOutOfBounds(\Intervention\Image\Image $image, $maxWidth = null, $maxHeight = null)
    {
        $maxWidth = ($maxWidth) ? $maxWidth : 1000;
        $maxHeight = ($maxHeight) ? $maxHeight : 1000;

        if ($image->width() > $maxWidth) {
            $image->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        if ($image->height() > $maxHeight) {
            $image->resize(null, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $image;
    }
}
