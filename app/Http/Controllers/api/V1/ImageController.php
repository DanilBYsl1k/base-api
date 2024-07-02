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
    }
}
