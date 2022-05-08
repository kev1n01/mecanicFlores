<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageVehicle extends Model
{
    use HasFactory;
    protected $table = "image_vehicles";
    protected $fillable = ['vehicle_plate','image'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
