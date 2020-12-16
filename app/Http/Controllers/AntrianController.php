<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antrian;
use App\Pasien;

class AntrianController extends Controller
{
    public function index()
    {
        return view('antrian');
    }
    public function store(Request $request)
    {        
        request()->validate([
            'noktp' => 'required|numeric',
            'user_id' => 'required'
        ]);

        $cekPasien = Pasien::where('noktp',request()->noktp);
        if ($cekPasien->get()->isEmpty()) {
            session()->flash('error');
        }else{
            session()->flash('success');
            Antrian::Create([
                'noktp' => $request->noktp,
                'status' => 'Menunggu',
                'user_id' => $request->user_id,
                'pasien_id' => $cekPasien->first()->id,
            ]);
        }
        return redirect(route('appointment'));
    }

}
