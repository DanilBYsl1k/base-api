<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['vehicle_img'];

    public function vehicle_img()
    {
        return $this->hasMany(Vehicle_img::class, 'vehicle_id', 'id');
    }
}
