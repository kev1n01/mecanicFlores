<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_status_id',
        'profile_photo_path',
        'ruc',
        'dni',
        'phone',
        'address',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [
        'profile_photo_url',
    ];
    public function user_status()
    {
        return $this->belongsTo(UserEstatus::class);
    }
    public function getImageUserAttribute(){
        return $this->profile_photo_path ?? $this->profile_photo_url;
    }
    public function getStatusNameAttribute(){
        return $this->user_status->name == 'active' ? 'activo' : 'inactivo';
    }
    public function scopeTermino($query,$termino){
        if($termino === ''){
            return;
        }

        return $query->where('name','like',"%{$termino}%")
        ->orWhere('email','like',"%{$termino}%")
        ->orWhere('id','like',"%{$termino}%");
    }
    public function scopeStatus($query,$status){
        if($status === ''){
            return;
        }

        return $query->where('user_status_id',"{$status}");
    }
    public function scopeName($query,$name){
        if($name === ''){
            return;
        }

        return $query->where('name','like',"%{$name}%");
    }
    public function scopeEmail($query,$email){
        if($email === ''){
            return;
        }

        return $query->where('email','like',"%{$email}%");
    }
}
