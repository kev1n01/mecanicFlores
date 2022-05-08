<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEstatus extends Model
{
    use HasFactory;
    protected $table = 'product_estatuses';

    protected $fillable = [
        'name',
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
