<?php

namespace App\Http\Controllers;

use App\Riwayat;
use App\Pasien;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index($id)
    {
        $pasien = Pasien::where('id',$id)->first();
        $riwayat = Riwayat::where('pasien_id',$id)->get();

        return view('admin/pasien/riwayat', compact('riwayat','pasien'));
    }

    public function create()
    {
        return view('admin/pasien/create_riwayat');
    }

    public function store(Request $request)
    {
        request()->validate([
            'diagnosis' => 'required|string',
            'obat' => 'required|string',
        ]);

        Riwayat::Create([
            'pasien_id' => $request->pasien_id,
            'diagnosis' => $request->diagnosis,
            'obat' => $request->obat,
        ]);

        return redirect(route('dashboard'))->withSuccess('Pasien selesai diperiksa');
    }

    public function print($id)
    {
        $pasien = Pasien::where('id',$id)->first();
        $riwayat = Riwayat::where('pasien_id',$id)->get();
        return view('admin.pasien.print_riwayat',compact('riwayat','pasien'));
    }

}
