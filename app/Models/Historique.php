<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Motif;

class Historique extends Model
{
    use HasFactory;
  
    public $timestamps = false;
  
    protected $fillable = [
        'user_id',
        'motif_id',
        'retard',
        'conge',
        'absent',
        'jrs_ferier',
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
        // OR return $this->belongsTo('App\User');
    }
    public function motif()
    {
        return $this->belongsTo(Motif::class);
        // OR return $this->belongsTo('App\User');
    }
}