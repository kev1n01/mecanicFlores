<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_products';
    
    protected $fillable = [
        'name_category',
    ];

    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }
        return $query->where('name_category','like',"%{$termino}%")
        ->orWhere('id','like',"%{$termino}%");
    }
    public function scopeName($query,$name){
        if($name === ''){
            return;
        }

        return $query->where('name_category','like',"%{$name}%");
    }
}
