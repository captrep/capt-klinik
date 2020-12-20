<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = 'riwayat';
    protected $fillable = [
        'pasien_id', 'diagnosis', 'obat',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
