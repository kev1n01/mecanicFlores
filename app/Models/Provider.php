<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'ruc',
        'name_company',
        'image',
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
    public function getImageProviderAttribute(){
        return $this->image ?? 'providers-photos/default.jpg';
    }

    public function provider_status()
    {
        return $this->belongsTo(ProviderEstatus::class);
    }
    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }

        return $query->where('name','like',"%{$termino}%")
            ->orWhere('phone','like',"%{$termino}%")
            ->orWhere('address','like',"%{$termino}%")
            ->orWhere('ruc','like',"%{$termino}%")
            ->orWhere('name_company','like',"%{$termino}%")
            ->orWhere('image','like',"%{$termino}%")
            ->orWhere('id','like',"%{$termino}%");
    }
    public function scopeStatus($query,$status){
        if($status === ''){
            return;
        }

        return $query->where('provider_status_id',"{$status}");
    }
    public function scopeName($query,$name){
        if($name === ''){
            return ;
        }

        return $query->where('name','like',"%{$name}%");
    }
    public function scopePhone($query,$name){
        if($name === ''){
            return ;
        }

        return $query->where('phone','like',"%{$name}%");
    }
    public function scopeAddress($query,$name){
        if($name === ''){
            return ;
        }

        return $query->where('address','like',"%{$name}%");
    }
    public function scopeRuc($query,$name){
        if($name === ''){
            return;
        }

        return $query->where('ruc','like',"%{$name}%");
    }
    public function scopeCompany($query,$name){
        if($name === ''){
            return;
        }

        return $query->where('name_company','like',"%{$name}%");
    }
}
