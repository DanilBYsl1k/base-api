<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use http\Env\Request;

class VehicleController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request['page'];
        $vehicles = Vehicle::orderBy('id', 'asc')
            ->simplePaginate(20, ['*'], 'page', $per_page);

        return VehicleResource::collection($vehicles);
    }

    public function create()
    {

    }
}
