<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use AndyCommerce\Core\Models\Shopper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'username', 'image', 'phone', 'email', 'role', 'status', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string';

    public function shopper(){
        return $this->hasOne(Shopper::class);
    }


    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if (empty($model->id)) {
            $model->id = (string) \Str::uuid();
        }
    });
}
}
