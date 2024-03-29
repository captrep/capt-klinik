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
        $antrianMenunggu = Antrian::where([['user_id',$id],['status','Menunggu']])->orderBy('created_at','ASC')->paginate(10);
        $antrianDilewati = Antrian::where([['user_id',$id],['status','Dilewati']])->paginate(10);
        $antrianDipanggil = Antrian::where([['user_id',$id],['status','Dipanggil']])->first();
        $antrianDiperiksa = Antrian::where([['user_id',$id],['status','Diperiksa']])->first();
        $antrianSelesai = Antrian::where([['user_id',$id],['status','Selesai']])->paginate(10);
        return view('antrian',compact('antrianMenunggu','antrianDilewati','antrianDipanggil','antrianDiperiksa', 'antrianSelesai'));
    }
    public function store(Request $request)
    {        
        request()->validate([
            'noktp' => 'required|numeric',
            'user_id' => 'required'
        ],[
            'noktp.required' => 'No ktp wajib diisi dong',
            'noktp.numeric' => 'Isinya pake angka dong, ini kan no ktp bukan no celana',
            'user_id.required' => 'Pilih dokternya dong, kalo ngga mau diperiksa sama satpam?'
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

    public function panggil($dokter)
    {
        $antrianMenunggu = Antrian::where([['user_id',$dokter],['status','Menunggu']])->orderBy('created_at','ASC')->get();
        $antrian = $antrianMenunggu->first();
        $antrian->status = 'Dipanggil';
        $antrian->save();
        return redirect(route('dashboard'));
    }

    public function panggilSkipped($dokter)
    {
        $antrianSkipped = Antrian::where([['user_id',$dokter],['status','Dilewati']])->orderBy('created_at','ASC')->get();
        $antrian = $antrianSkipped->first();
        $antrian->status = 'Dipanggil';
        $antrian->save();
        return redirect(route('dashboard'));
    }

    public function periksa($id)
    {
        $antrian = Antrian::find($id);
        $antrian->status = 'Diperiksa';
        $antrian->save();
        return redirect(route('riwayat.pasien',$antrian->pasien_id));
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
    
    public function hapusAntrian($dokter)
    {
        Antrian::where('user_id',$dokter)->delete();
        return redirect()->back()->withSuccess('Antrian berhasil dikosongkan');
    }

}
