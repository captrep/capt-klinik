<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $fillable = [
        'nama', 'umur', 'noktp', 'jenkel', 'alamat', 'nohp', 'status',
    ];

    public function riwayat()
    {
        return $this->hasMany(Riwayat::class);
    }

}
