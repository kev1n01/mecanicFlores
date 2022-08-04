<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'items',
        'cash',
        'change',
        'status_sale_id',//pagada-pendiente-cancelada
        'user_id',
        'customer_id',
    ];

    public function sale_status()
    {
        return $this->belongsTo(SaleEstatus::class, 'status_sale_id');
    }

    public function customer(){
        return $this->belongsTo(User::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }

        return $query->where('provider_id','like',"%{$termino}%")
            ->orWhere('user_id','like',"%{$termino}%")
            ->orWhere('total','like',"%{$termino}%")
            ->orWhere('code_purchase','like',"%{$termino}%")
            ->orWhere('date_purchase','like',"%{$termino}%")
            ->orWhere('observation','like',"%{$termino}%")
            ->orWhere('status','like',"%{$termino}%")
            ->orWhere('id','like',"%{$termino}%");
    }
    public function scopeDate($query,$date){
        if($date === '' ){
            return ;
        }

        return $query->where('created_at','like',"%{$date}%");
    }

}
