<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'noktp', 'status', 'user_id',
    ];

    public function antrian()
    {
        return $this->belongsTo(User::class);
    }
}
