<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'pasien_id', 'testi',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
