<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    use HasFactory;
    protected $table = "type_vehicles";

    protected $fillable = ['type_vehicle'];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
