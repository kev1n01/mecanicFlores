<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseEstatus extends Model
{
    use HasFactory;
    protected $table = 'purchase_estatuses';

    protected $fillable = [
        'name',
    ];
    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
