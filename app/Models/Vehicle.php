<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'brand_id',
        'color_id',
        'customer_id',
        'license_plate',
        'model_year',
        'image',
        'description',
    ];

    public function getImageVehicleAttribute(){
        return $this->image ?? 'vehicle-photos/default.jpg';
    }
    public function images(){
        return $this->belongsTo(ImageVehicle::class);
    }
    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(TypeVehicle::class);
    }

    public function brand(){
        return $this->belongsTo(BrandVehicle::class);
    }

    public function color(){
        return $this->belongsTo(ColorVehicle::class);
    }

    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }

        return $query->where('type_id','like',"%{$termino}%")
            ->orWhere('brand_id','like',"%{$termino}%")
            ->orWhere('color_id','like',"%{$termino}%")
            ->orWhere('customer_id','like',"%{$termino}%")
            ->orWhere('license_plate','like',"%{$termino}%")
            ->orWhere('model_year','like',"%{$termino}%")
            ->orWhere('description','like',"%{$termino}%")
            ;
    }

    public function scopeType($query,$type){
        return $query->where('type_id','=',$type);
    }

    public function scopeBrand($query,$brand){
        return $query->where('brand_id','=',$brand);
    }
    public function scopeColor($query,$color){
        return $query->where('color_id','=',$color);
    }

    public function scopeCustomer($query,$customer){
        return $query->where('customer_id','=',$customer);
    }

    public function scopePlate($query,$license_plate){
        if($license_plate === ''){
            return;
        }

        return $query->where('license_plate','like',"%{$license_plate}%");
    }

    public function scopeModel($query,$model_year){
        if($model_year === ''){
            return;
        }

        return $query->where('model_year','like',"%{$model_year}%");
    }

    public function scopeDescription($query,$description){
        if($description === ''){
            return;
        }

        return $query->where('description','like',"%{$description}%");
    }
}
