<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'card_service',
        'category_id',
        'user_id',
        'vehicle_id',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class,);
    }
    public function employer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id');
    }


    public function scopeEmple($query,$employer)
    {
        if ($employer=== '') {
            return;
        }

        return $query->orWhereHas('user', function ($q) {
            $q->where('id', "{$employer}");
        });
    }

    public function scopePlate($query,$plate)
    {
        if ($plate=== '') {
            return;
        }

        return $query->orWhereHas('vehicle', function ($q) {
            $q->where('license_plate','like',"%{$plate}%");
        });
    }
    public function scopeCard($query,$card){
        if($card === ''){
            return;
        }

        return $query->where('card_service','like',"%{$card}%");
    }
    public function scopeDate($query,$date){
        if($date === '' ){
            return ;
        }

        return $query->where('created_at','like',"%{$date}%");
    }

}
