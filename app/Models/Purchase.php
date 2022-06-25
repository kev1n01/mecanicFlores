<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'provider_id',
        'user_id',
        'total',
        'code_purchase',
        'date_purchase',
        'observation',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function provider(){
        return $this->belongsTo(Provider::class);
    }
    public function purchaseDetails(){
        return $this->hasMany(PurchaseDetail::class);
    }

    public function purchase_status()
    {
        return $this->belongsTo(PurchaseEstatus::class, 'status');
    }
    public function getStatusColorAttribute(){
        if($this->purchase_status->name == 'nueva'){ return 'badge-pill badge-info-inverse';}
            if($this->purchase_status->name == 'aprobada'){ return 'badge-pill badge-primary-inverse';}
        if($this->purchase_status->name == 'restrasada'){ return 'badge-pill badge-warning-inverse';}
        if($this->purchase_status->name == 'recibida'){ return 'badge-pill badge-success-inverse';}
        if($this->purchase_status->name == 'anulada'){ return 'badge-pill badge-danger-inverse';}
    }
    public function scopeStatus($query,$status){
        if($status === ''){
            return;
        }

        return $query->where('status',"{$status}");
    }
    public function scopeUse($query,$user){
        if($user === ''){
            return;
        }

        return $query->where('user_id',"{$user}");
    }
    public function scopeProvide($query,$provider){
        if($provider === ''){
            return;
        }

        return $query->where('provider_id',"{$provider}");
    }

    public function scopeCode($query,$code){
        if($code === ''){
            return ;
        }

        return $query->where('code_purchase','like',"%{$code}%");
    }
    public function scopeObservation($query,$observation){
        if($observation === ''){
            return ;
        }

        return $query->where('observation','like',"%{$observation}%");
    }
//    public function scopeDate($query,$from,$to){
//        if($from === '' && $to === ''){
//            return ;
//        }
//
//        return $query->whereBetween('date_purchase',[$from,$to]);
//    }
    public function scopeDate($query,$date){
        if($date === '' ){
            return ;
        }

        return $query->where('date_purchase','=',$date);
    }

    public function scopeTotal($query,$total){
        if($total === ''){
            return ;
        }

        return $query->where('total','like',"%{$total}%");
    }

    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }

        return $query->where('total','like',"%{$termino}%")
            ->orWhere('items','like',"%{$termino}%")
            ->orWhere('cash','like',"%{$termino}%")
            ->orWhere('change','like',"%{$termino}%")
            ->orWhere('customer_id','like',"%{$termino}%")
            ->orWhere('status_sale_id','like',"%{$termino}%")
            ->orWhere('user_id','like',"%{$termino}%")
            ->orWhere('id','like',"%{$termino}%");
    }
}
