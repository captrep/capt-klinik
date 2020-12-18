<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antrian;
use App\Pasien;
use App\User;

class AntrianController extends Controller
{
    public function index($username)
    {
        $id = User::where('username',$username)->pluck('id');
        $antrianMenunggu = Antrian::where([['user_id',$id],['status','Menunggu']])->orderBy('created_at','ASC')->paginate(5);
        $antrianDilewati = Antrian::where([['user_id',$id],['status','Dilewati']])->paginate(5);
        $antrianDipanggil = Antrian::where('status','Dipanggil')->first();
        $antrianDiperiksa = Antrian::where('status','Diperiksa')->first();
        return view('antrian',compact('antrianMenunggu','antrianDilewati','antrianDipanggil','antrianDiperiksa'));
    }
    public function store(Request $request)
    {        
        request()->validate([
            'noktp' => 'required|numeric',
            'user_id' => 'required'
        ]);

        $cekPasien = Pasien::where('noktp',request()->noktp);
        $cekAntrian = Antrian::where('noktp', request()->noktp);
        if ($cekPasien->get()->isEmpty()) {
            session()->flash('error');
        }else if($cekPasien->first()->status == 'Belum Aktif'){
            session()->flash('warning');
        }else if($cekAntrian->get()->isNotEmpty()){
            session()->flash('duplicate');
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

    public function panggil($id)
    {
        $antrian = Antrian::find($id);
        $antrian->status = 'Dipanggil';
        $antrian->save();
        return redirect(route('dashboard'));
    }

    public function periksa($id)
    {
        $antrian = Antrian::find($id);
        $antrian->status = 'Diperiksa';
        $antrian->save();
        return redirect(route('dashboard'));
    }

    public function lewati($id)
    {
        $antrian = Antrian::find($id);
        $antrian->status = 'Dilewati';
        $antrian->save();
        return redirect(route('dashboard'));
    }

    public function selesai($id)
    {
        $antrian = Antrian::find($id);
        $antrian->status = 'Selesai';
        $antrian->save();
        return redirect(route('dashboard'));
    }

}
