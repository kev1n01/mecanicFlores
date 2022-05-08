<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorVehicle extends Model
{
    use HasFactory;
    protected $table = "color_vehicles";

    protected $fillable = ['color_vehicle'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
