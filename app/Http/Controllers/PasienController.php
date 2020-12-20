<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;

class PasienController extends Controller
{
    public function index(Pasien $pasien)
    {
        $pasien = Pasien::orderBy('created_at','DESC')->paginate(10);
        return view('admin/pasien/list', compact('pasien'));
    }

    public function create()
    {
        return view('admin/pasien/create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required|string',
            'umur' => 'required|numeric|max:100',
            'noktp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required|numeric',
            'status' => 'required',
        ]);

        Pasien::Create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'noktp' => $request->noktp,
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'status' => $request->status,
        ]);

        return redirect(route('pasien'))->withSuccess('Data Berhasil Ditambahkan!');
    }

    public function edit(Pasien $pasien)
    {
        return view('admin/pasien/edit', compact('pasien'));
    }

    public function update(Pasien $pasien)
    {
        $attr =  request()->validate([
            'nama' => 'required|string',
            'umur' => 'required|numeric|max:100',
            'noktp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required|numeric',
            'status' => 'required',
        ]);

        $pasien->update($attr);
        return redirect(route('pasien'))->withSuccess('Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        Pasien::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Data Berhasil Dihapus!');
    }

    public function register()
    {
        return view('register');
    }

    public function storelanding(Request $request)
    {
        request()->validate([
            'nama' => 'required|string',
            'umur' => 'required|numeric|max:100',
            'noktp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required|numeric',
        ]);
        
        Pasien::Create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'noktp' => $request->noktp,
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'status' => 'Belum Aktif',
        ]);
        
        session()->flash('success');
        return redirect(route('register.pasien'))->withSuccess('Data Berhasil Diubah!');
    }

    public function konfirmasi($pasien)
    {
        $pasien = Pasien::find($pasien);
        $pasien->status = 'Aktif';
        $pasien->save();
        return redirect(route('dashboard'))->withSuccess('Pasien berhasil dikonfirmasi');
    }
}
