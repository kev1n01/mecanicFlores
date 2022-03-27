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

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_status_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    
    public function user_status()
    {
        return $this->belongsTo(UserEstatus::class)->withDefault();
    }

    public function getImageUserAttribute(){
        return $this->profile_photo_path ?? 'profile-photos/default.jpg';
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

        return $query->where('user_status_id','like',"%{$status}%");
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
