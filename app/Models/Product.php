<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'code',
        'name',
        'stock',
        'image',
        'sale_price',
        'purchase_price',
        'unit',
        'product_status_id',
        'category_product_id',
        'brand_product_id',
    ];


    public function product_status()
    {
        return $this->belongsTo(ProductEstatus::class);
    }
    public function category_product()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
    public function brand_product()
    {
        return $this->belongsTo(BrandProduct::class);
    }
    public function getImageProductAttribute(){
        return $this->image ?? 'products-photos/default.jpg';
    }

    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }

        return $query->where('name','like',"%{$termino}%")
            ->orWhere('code','like',"%{$termino}%")
            ->orWhere('stock','like',"%{$termino}%")
            ->orWhere('sale_price','like',"%{$termino}%")
            ->orWhere('purchase_price','like',"%{$termino}%")
            ->orWhere('unit','like',"%{$termino}%")
            ->orWhere('id','like',"%{$termino}%");
    }

    public function scopeStatus($query,$status){
        if($status === ''){
            return;
        }

        return $query->where('product_status_id',"{$status}");
    }

    public function scopeBrand($query,$brand){
        if($brand === ''){
            return;
        }

        return $query->where('brand_product_id',"{$brand}");
    }
    public function scopeCategory($query,$category){
        if($category === ''){
            return;
        }

        return $query->where('category_product_id',"{$category}");
    }

    public function scopeName($query,$name){
        if($name === ''){
            return;
        }

        return $query->where('name','like',"%{$name}%");
    }

    public function scopeStock($query,$stock){
        if($stock === ''){
            return;
        }

        return $query->where('stock','like',"%{$stock}%");
    }
    public function scopeSale($query,$sale){
        if($sale === ''){
            return;
        }

        return $query->where('sale_price','like',"%{$sale}%");
    }
    public function scopePurchase($query,$purchase){
        if($purchase === ''){
            return;
        }

        return $query->where('purchase_price','like',"%{$purchase}%");
    }

    public function scopeCode($query,$code){
        if($code === ''){
            return;
        }

        return $query->where('code','like',"%{$code}%");
    }

    public function scopeUnit($query,$unit){
        if($unit === ''){
            return;
        }

        return $query->where('unit','like',"%{$unit}%");
    }
}
