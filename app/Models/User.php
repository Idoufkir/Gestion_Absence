<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'intitule',
        'password',
        'day_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasRole(string $role): bool
    {
        return $this->getAttribute('role') === $role;
    }
    
    public function getId()
    {
        return $this->id;
    }
    public function historique()
    {
        return $this->hasOne(Historique::class);
        // OR return $this->hasOne('App\Phone');
    }

    public function motif() 
    {
        return $this->belongsTo(Motif::class);
    }

    public function touchLastLogin()
     {
        $this->day_login_at = $this->freshTimestamp();

        return $this->save();
     }
}
