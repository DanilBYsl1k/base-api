<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\VehicleResource;
use App\Jobs\ProcessVehiclePurchase;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request['page'];
        $vehicles = Vehicle::orderBy('id', 'asc')
            ->simplePaginate(10, ['*'], 'page', $per_page);
        return VehicleResource::collection($vehicles)->resolve();
    }

    public function create(Request $request)
    {
        $vehicle = Vehicle::firstOrCreate($request);

        return VehicleResource::make($vehicle)->resolve();
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle = $vehicle->update($request);

        return VehicleResource::make($vehicle)->resolve();
    }

    public function destroy($id){
        Vehicle::destroy($id);
    }

    public function vehicleBuy($id)
    {

        try {
            ProcessVehiclePurchase::dispatch($id);
        } catch (\Exception $exception) {
            return '';
        }


        return 'ok';
    }
}
