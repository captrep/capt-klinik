<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    protected $table = 'antrian';
    protected $fillable = [
        'noktp', 'status', 'user_id', 'pasien_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
