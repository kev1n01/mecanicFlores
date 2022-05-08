<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelVehicle extends Model
{
    use HasFactory;
    protected $table = "model_vehicles";

    protected $fillable = ['model_vehicle',];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
