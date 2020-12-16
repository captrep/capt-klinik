<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antrian;
use App\Pasien;

class AntrianController extends Controller
{
    public function index(Antrian $antrian)
    {

    }

    public function store(Request $request)
    {        
        request()->validate([
            'noktp' => 'required|numeric',
            'user_id' => 'required'
        ]);

        $cekPasien = Pasien::where('noktp',request()->noktp)->get();
        if ($cekPasien->isEmpty()) {
            session()->flash('error');
        }else{
            session()->flash('success');
        }
        return redirect(route('welcome'));
    }
}
