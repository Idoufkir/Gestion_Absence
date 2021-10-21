<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;
    protected $fillable = [
        'Motifname',
        'created_at',
        'duration',
        'comment',
        'user_id',
        'status',
        
    ];

    public function historique()
    {
        return $this->hasMany(Historique::class);
        // OR return $this->hasOne('App\Phone');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // OR return $this->belongsTo('App\User');
    }
}
