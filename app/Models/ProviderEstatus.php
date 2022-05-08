<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderEstatus extends Model
{
    use HasFactory;
    protected $table = 'provider_estatuses';

    protected $fillable = [
        'name',
    ];
    public function providers(){
        return $this->hasMany(Provider::class);
    }

}
