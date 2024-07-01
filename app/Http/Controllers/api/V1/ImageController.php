<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Image\UploadRequest;
use Illuminate\Support\Facades\Storage;

class ImageController extends BaseController
{
    public function upload(UploadRequest $request)
    {
        $data = $request->validated();

        $path = Storage::disk('public')->put('/images', $data['image']);

//        if ($request->hasFile('image')) {
//            $file = $data['image'];
//            $file_name = $file->getClientOriginalName();
//            $file->move(public_path('images'), $file_name);
//
//            return $this->sendResponse();
//        }

//        return $this->sendResponse();
    }
}
