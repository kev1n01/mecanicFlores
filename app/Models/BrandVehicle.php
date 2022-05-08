<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandVehicle extends Model
{
    use HasFactory;
    protected $table = "brand_vehicles";

    protected $fillable = ['brand_vehicle','type_vehicle_id'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function type(){
        return $this->belongsTo(TypeVehicle::class);
    }
}
